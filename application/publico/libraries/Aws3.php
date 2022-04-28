<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of AmazonS3
 *
 * @author wahyu widodo
 */

include("./vendor/autoload.php");

use Aws\S3\S3Client;

class Aws3{
	
	private $S3;

	public function __construct(){
		$this->S3 = S3Client::factory([
			// old lab
			'key' => 'AKIAZ3GVX5TE4WVLEQU2',
			'secret' => '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',
			// new prod
			// 'key' => 'AKIASE2LHDBDGBE4Z4PF',
			// 'secret' => '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',
			//'region' => 'us-west-1'
			'region' => 'us-east-2',
			'signature' => 'v4',

		]);
	}	
	
	public function addBucket($bucketName){
		$result = $this->S3->createBucket(array(
			'Bucket'=>$bucketName,
			'LocationConstraint'=> 'us-east-2'));
		return $result;	
	}
	
	public function sendFile($bucketName, $filename,$folder_name){
		$result = $this->S3->putObject(array(
			'Bucket' => $bucketName,
				//'Key'        => 'photos/summer/' . basename($localImage)
			'Key' =>$folder_name,
			'SourceFile' => $filename['tmp_name'],
				//'ContentType' => 'image/png',
				//'ContentType' => 'application/pdf',

			'StorageClass' => 'STANDARD',
			'ACL' => 'public-read'
		));
		return $result['ObjectURL']."\n";
	}

	//listar archivos
	public function ListFile($bucketName,$folder_name){
			$objects = $this->S3->getIterator('ListObjects', array(
			"Bucket" => $bucketName,
	    	"Prefix" => $folder_name.'/' //must have the trailing forward slash "/"
		));



		
			return $objects;
		}

	public function zipfile($bucketName,$folder_name){

		//$s3 = Aws\S3\S3Client::factory(/* sdk config */);
		$this->S3->registerStreamWrapper();

		$zip = new ZipArchive;
		//$zip->open('/path/to/zip-you-are-creating.zip', ZipArchive::CREATE);
		//borrar archivo previo


		$path_to_file = './archivos/archivos.zip';
		if(unlink($path_to_file)) {
			echo 'deleted successfully';
		}
		else {
			echo 'errors occured';
		}


		$zip->open('./archivos/archivos.zip', ZipArchive::CREATE);

		$bucket = $bucketName;
		$prefix = $folder_name.'/'; // ex.: 'image/test/folder/'
		$objects = $this->S3->getIterator('ListObjects', array(
			'Bucket' => $bucket,
			'Prefix' => $prefix
		));



		foreach ($objects as $object) {
		    $contents = file_get_contents("s3://{$bucket}/{$object['Key']}"); // get file

		   
		    if ($contents!="") {
		    	$archivo=explode( '/', $object['Key'] );

		    	$longitud=count($archivo)-1;
		    	
		    	
		    	$zip->addFromString($archivo[$longitud], $contents); // add file contents in zip
		    	
		    }
		
		    
		    //$zip->addFile($contents);

		}

		$zip->close();

		// Download de zip file
		header("Content-Description: File Transfer"); 
		header("Content-Type: application/octet-stream"); 
		//header("Content-Disposition: attachment; filename=\"/path/to/zip-you-are-creating.zip\""); 
		header("Content-Disposition: attachment; filename=\"/archivos.zip\""); 
		//readfile ('/path/to/zip-you-are-creating.zip');
		readfile ('./archivos/archivos.zip');

			
	}

	//descargar seleccionados
	public function zipfileSelected($bucketName,$folder_name,$nombres_archivos){

	//$s3 = Aws\S3\S3Client::factory(/* sdk config */);
	$this->S3->registerStreamWrapper();

	$zip = new ZipArchive;
	//$zip->open('/path/to/zip-you-are-creating.zip', ZipArchive::CREATE);
	//borrar archivo previo


	$path_to_file = './archivos/archivos.zip';
	if(unlink($path_to_file)) {
		echo 'deleted successfully';
	}
	else {
		echo 'errors occured';
	}


	$zip->open('./archivos/archivos.zip', ZipArchive::CREATE);

	$bucket = $bucketName;
	$prefix = $folder_name.'/'; // ex.: 'image/test/folder/'
	$objects = $this->S3->getIterator('ListObjects', array(
		'Bucket' => $bucket,
		'Prefix' => $prefix
	));

	

	foreach ($objects as $object) {
	    $contents = file_get_contents("s3://{$bucket}/{$object['Key']}"); // get file

	   
	    if ($contents!="") {
	    	$archivo=explode( '/', $object['Key'] );	    	
	    	$longitud=count($archivo)-1;
	    	//adicionamos solo los archivos seleccionados

	    	for ($j = 0; $j < count($nombres_archivos); $j++) {

	    		if ($archivo[$longitud]==$nombres_archivos[$j]) {
	    			$zip->addFromString($archivo[$longitud], $contents); // add file contents in zip
	    			 break;//terminamos el for

	    		}
	    	
	    	
	    	}
	    	// fin de add solo seleccionados
	}
	    
	    //$zip->addFile($contents);

	}

	$zip->close();

	// Download de zip file
	header("Content-Description: File Transfer"); 
	header("Content-Type: application/octet-stream"); 
	//header("Content-Disposition: attachment; filename=\"/path/to/zip-you-are-creating.zip\""); 
	header("Content-Disposition: attachment; filename=\"/archivos.zip\""); 
	//readfile ('/path/to/zip-you-are-creating.zip');
	readfile ('./archivos/archivos.zip');

			
	}

	public function deleteFile($bucketName, $ruta_archivo){
        $result = $this->S3->deleteObject([
        'Bucket' => $bucketName,
        'Key' => $ruta_archivo,//"/docs/archvio.txt "
        ]);     
    }

    //crear carpeta vacia
    public function createFolder($bucketName, $folder_name){
		$result = $this->S3->putObject(array(
			'Bucket' => $bucketName,
				//'Key'        => 'photos/summer/' . basename($localImage)
			// 'Key' =>$folder_name.'/dato.txt',
			'Key' =>$folder_name,
			'Body'   => '',

			'StorageClass' => 'STANDARD',
			'ACL' => 'public-read'
		));
		
	}
}