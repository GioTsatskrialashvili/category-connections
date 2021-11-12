<?php include('helpers/db_connection.php') ?>

<?php include('components/header.php') ?>
    
<?php include('components/aside.php') ?>

<?php

    $id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : null; 
    
    if($id) {
        // select
        $select_query = "SELECT * FROM news WHERE id = " . $id;

        $result = mysqli_query($conn, $select_query);
        $news = mysqli_fetch_assoc($result); // []

        if(!$news) {
            die('news not found');
        }
    } else {
        die('invalid id');
    }

    // update
    if(isset($_POST['action']) && $_POST['action'] == 'update') {
        $title = isset($_POST['title']) ? $_POST['title'] : '' ;
        $text= isset($_POST['text']) ? $_POST['text'] : '' ;
      

        if($text && $title ) {

            $sql = "UPDATE news SET title = '$title', text = '$text' WHERE id = ".$id;

            if(mysqli_query($conn, $sql)) {
                header('Location:index.php');
            } else {
                echo "Error";
            }
        }
    }

?>

<main>
    <div class="container-header">
        <h2>News</h2>
        <a href="index.php" class="btn">Back</a>
    </div>
    <div class="content">
        <form action="" method="post">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" value="<?= $news['title'] ?>">
            </div>
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="text" value="<?= $news['text'] ?>">
            </div>          
            <div class="form-group">
                <input type="hidden" name="action" value="update">
                <button class="btn submit">Update</button>
            </div>
        </form>
    </div>
</main>

<?php include('components/footer.php') ?>