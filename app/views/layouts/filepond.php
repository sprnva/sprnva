<link rel="stylesheet" href="<?= public_url('/assets/sprnva/css/filepond/filepond-plugin-image-preview.min.css') ?>">
<link rel="stylesheet" href="<?= public_url('/assets/sprnva/css/filepond/filepond-plugin-image-edit.css') ?>">
<link rel="stylesheet" href="<?= public_url('/assets/sprnva/css/filepond/filepond.css') ?>">

<script src="<?= public_url('/assets/sprnva/js/filepond/filepond-plugin-file-encode.min.js') ?>"></script>
<script src="<?= public_url('/assets/sprnva/js/filepond/filepond-plugin-file-validate-size.min.js') ?>"></script>
<script src="<?= public_url('/assets/sprnva/js/filepond/filepond-plugin-file-validate-type.js') ?>"></script>
<script src="<?= public_url('/assets/sprnva/js/filepond/filepond-plugin-image-exif-orientation.min.js') ?>"></script>
<script src="<?= public_url('/assets/sprnva/js/filepond/filepond-plugin-image-preview.min.js') ?>"></script>
<script src="<?= public_url('/assets/sprnva/js/filepond/filepond-plugin-image-resize.js') ?>"></script>
<script src="<?= public_url('/assets/sprnva/js/filepond/filepond-plugin-image-crop.js') ?>"></script>
<script src="<?= public_url('/assets/sprnva/js/filepond/filepond-plugin-image-edit.js') ?>"></script>
<script src="<?= public_url('/assets/sprnva/js/filepond/filepond-plugin-image-transform.js') ?>"></script>
<script src="<?= public_url('/assets/sprnva/js/filepond/filepond.js') ?>"></script>

<script>
    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageTransform,
        FilePondPluginImageEdit
    );
</script>