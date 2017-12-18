<?php
include "Common/Picture.php";
session_start();
include "Common/Header.php";

//
if(isset($_GET["action"]))
{
    $action = $_GET["action"];
    if ($action == "delete")
    {
        $filePath = $_GET["filePath"];
        $fileName = Picture::getFileNameFromPath($filePath);
        Picture::deletePicture($fileName);
        header("Location: MyPictures.php");
        die();
    }
}

$pictureArray = Picture::getPictures();
?>

<div class="container">
    <?php if (empty($pictureArray)): ?>
    <div class="row">
        <h2>There are currently no pictures inside the gallery</h2>
        <p>
            You can upload your pictures
            <a href="UploadPicture.php">here</a>
        </p>
    </div>
    <?php else : ?>
    <div class="row">
        <h2 id="currentImageName" class="content-center">
            <?php echo $pictureArray[0]->getName(); ?>
        </h2>
    </div>
    <div class="row">
        <div id="currentImageContainer" class="img-container">
            <img id="currentImage"
                src="<?php echo $pictureArray[0]->getAlbumFilePath(); ?>"
                data-id="<?php echo $pictureArray[0]->getId(); ?>"
                data-name="<?php echo $pictureArray[0]->getName(); ?>"
                data-original-src="<?php echo $pictureArray[0]->getOriginalFilePath(); ?>"
                data-album-src="<?php echo $pictureArray[0]->getAlbumFilePath(); ?>"
                data-thumbnail-src="<?php echo $pictureArray[0]->getThumbnailFilePath(); ?>" />


            <div id="currentImageLinkContainer" class="img-link-container">
                <a id="rotateLeftLink" class="imageButton" data-action="rotateLeft" href="#">
                    <span class="glyphicon glyphicon-repeat gly-flip-horizontal"></span>
                </a>
                <a id="rotateRightLink" class="imageButton" data-action="rotateRight" href="#">
                    <span class="glyphicon glyphicon-repeat"></span>
                </a>
                <a id="downloadLink" class="imageButton" data-action="download" href="<?php echo $pictureArray[0]->getOriginalFilePath(); ?>" download>
                    <span class="glyphicon glyphicon-download-alt"></span>
                </a>
                <a id="deleteLink" class="imageButton" data-action="delete" href="#">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="carousel">
            <?php foreach ($pictureArray as $picture): ?>
            <div class="slide">
                <img class="thumbnailImage" onclick="changePictures"
                    src="<?php echo $picture->getThumbnailFilePath(); ?>"
                    data-id="<?php echo $picture->getId(); ?>"
                    data-name="<?php echo $picture->getName(); ?>"
                    data-original-src="<?php echo $picture->getOriginalFilePath(); ?>"
                    data-album-src="<?php echo $picture->getAlbumFilePath(); ?>"
                    data-thumbnail-src="<?php echo $picture->getThumbnailFilePath(); ?>" />
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<br />

<?php include "Common/Footer.php"; ?>