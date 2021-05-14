</div>
<script>
    FilePond.registerPlugin(

        // encodes the file as base64 data
        FilePondPluginFileEncode,

        // validates the size of the file
        FilePondPluginFileValidateSize,

        // corrects mobile image orientation
        FilePondPluginImageExifOrientation,

        // previews dropped images
        FilePondPluginImagePreview
    );

    const inputElement = document.querySelector('input[type="file"]');
    FilePond.create(inputElement);
</script>
</body>

</html>