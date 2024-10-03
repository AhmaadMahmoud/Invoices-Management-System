<!-- resources/views/pdf_view.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>View PDF</title>
</head>
<body>

    {{ $contents }}
    <h1>View PDF</h1>
    {{-- <iframe src="" width="100%" height="600px">
        This browser does not support PDFs. Please download the PDF to view it:
        <embed src="{{ $contents }}" type="application/pdf" width="100%" height="600px" />
        <a href="{{ $contents }}">Download PDF</a>
    </iframe> --}}

</body>
</html>
