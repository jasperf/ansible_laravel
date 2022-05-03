<?php

namespace App\Http\Controllers;

use App\Notepad;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SaveTextController extends Controller
{

    public function __construct()
    {
        $this->basePath = 'savetext/';
    }

    public function index()
    {
        // Disable caching.
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        $randomParams = substr(str_shuffle('123456789abcdefghjkmnpqrstwxyz'), -9);

        return redirect(route('save-text.show', ['note' => $randomParams]));
    }

    public function show(Request $request) {
        $notePath = $request->note;
        $pathFile = $this->basePath . $notePath;

        if (Storage::exists($pathFile)) {
            header('Content-type: text/plain');
            $content = Storage::get($pathFile);
            $notepad = Notepad::where(['url' => $notePath])->first();

            if (!empty($notepad)) {
                return view('save_text.index', compact('content', 'notepad', 'notePath'));
            }

            return view('save_text.index', compact('content', 'notePath'));
        }

        if (strlen($notePath) > 64) return $this->index();

        return view('save_text.index', compact('notePath'));
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->t)) {
                Storage::put($this->basePath . $request->note, $request->t);
            } else {
                Storage::delete($this->basePath . $request->note, $request->t);
                if ($notepad = Notepad::where('url', $request->note)->first()) {
                    $notepad->delete();
                }
            }
        } catch (\Exception $exception) {
            return false;

            report($exception);
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();
        if (!empty($data['type']) && !empty($data['url'])) {
            $notepad = Notepad::where('url', $data['url'])->first();
            if ($notepad) {
                $notepad->update($data);
            } else {
                Notepad::create($data);
            }

            return response()->json($data, 200);
        }

        return response()->json('Not found!', 400);
    }
}
