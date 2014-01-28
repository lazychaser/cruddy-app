@extends('layouts.master')

@section('content')

    <div id="editor" style="height: 200px">
Test Markdown
-------------

Hello, world!
    </div>

@stop

@section('scripts')
    <script src="{{ asset('cruddy/assets/vendor/ace-builds/src-noconflict/ace.js') }}"></script>
    <script src="{{ asset('cruddy/assets/vendor/ace-builds/src-noconflict/mode-markdown.js') }}"></script>
    <script src="{{ asset('cruddy/assets/vendor/ace-builds/src-noconflict/theme-monokai.js') }}"></script>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setMode("ace/mode/markdown");
    </script>
@stop