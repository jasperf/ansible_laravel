<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Save Notepad online - Save note online 1</title>
    <meta name="description"
          content="Save Notepad Online, save your note, Secure your note. SaveNotepad.online save notes online, save notes, notepad online, online notepad, simple notepad"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="robots" content="index">
    <meta name="google-site-verification" content="TBeQXRpRWAa4R-xMWoPgMgRWlxb9vYpMP94J1xDRMsk" />
    <meta name="googlebot" content="index">
    <meta name="generator" content="Savenote.online - Website save text online">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="shortcut icon" type="image/gif" href="{{ url('favicon.ico') }}"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


<div class="main">
    <div id="window">
        <div id="buttons">
            <a href="#" id="default"></a>
            <a href="#" id="greenbtn"></a>
            <a href="#" id="pinkbtn"></a>
            <a href="#" id="blackbtn"></a>
        </div>
        <div id="title">Notepad </div>
    </div>
    @isset($content)
        <textarea data-note-path={{ $notePath }} data-type={{ $notepad['type'] ?? 0}} id="content" spellcheck="false">{{ $content }}</textarea>
    @else
        <textarea data-note-path={{ $notePath }} data-type="0" id="content" spellcheck="false"></textarea>
    @endisset


</div>
<pre id="printable"></pre>
<script src="{{ url('js/save_text.js') }}"></script>
<script src="{{ url('js/main.js') }}"></script>
</body>
</html>
