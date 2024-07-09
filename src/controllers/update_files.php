<?php
// Codigo para Debugging
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['save'])) {
//         // Check if a file was uploaded
//         if (isset($_FILES['imagen_local']) && $_FILES['imagen_local']['error'] === UPLOAD_ERR_OK) {
//             // $url = upload_img($_FILES['imagen_local']);
//             echo 'File was uploaded successfully: ';
//             if ($url) {
//                 // File was uploaded successfully
//                 echo 'File was uploaded successfully: ' . $url;
//             } else {
//                 // File was not uploaded successfully
//                 echo 'File was not uploaded successfully.';
//             }
//         } else {
//             // No file was uploaded or an error occurred
//             echo 'No file uploaded or an error occurred.';
//         }
//     }
// }

function upload_img($file, $config){
    // require '../../aws-sdk-php/aws-autoloader.php'; --> Agregar antes de llamar a la funcion
    // $config = parse_ini_file('../../config/config.ini', true); --> Agregar antes de llamar a la funcion

    // Acceder a las variables
    $awsSecretKey = $config['database']['AWS_SECRET_KEY'];
    $AwsAccessKey = $config['database']['AWS_ACCESS_KEY'];
    
    $s3 = new \Aws\S3\S3Client([
        'region'  => 'auto',
        'version' => 'latest',
        'endpoint' => 'https://4749becd632a3ba7ac5e91965e12d3be.r2.cloudflarestorage.com',
        'use_path_style_endpoint' => true,
        'credentials' => [
            'key'    => $AwsAccessKey,
            'secret' => $awsSecretKey,
        ],
    ]);

    $bucket = 'bajorosario';
    $key = 'images/' . basename($file['name']);

    try {
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key'    => $key,
            'SourceFile' => $file['tmp_name'],
            'ACL'    => 'public-read', // Make the file publicly accessible
        ]);

        // Return the URL of the uploaded image
        // return $result['ObjectURL'];
        return 'https://pub-6d29dc65ed78442db1957c22eac48272.r2.dev/images/'. basename($file['name']);
    } catch (\Aws\Exception\AwsException $e) {
        // Output error message if fails
        echo $e->getMessage();
        echo "\n";
    }

    return false;

};



?>

<!-- Codigo para Debugging -->
<!-- <!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="imagen_local">
        <input type="submit" name="save" value="Save File">
    </form>
</body>
</html> -->