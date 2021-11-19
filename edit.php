<?php include('helpers/db_connection.php') ?>

<?php include('components/header.php') ?>
    
<?php include('components/aside.php') ?>

<?php
     $sql1 = "SELECT * FROM categories";
     $result1 = mysqli_query($conn, $sql1);
     $categories = mysqli_fetch_all($result1, MYSQLI_ASSOC);
     
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
        $category_id=isset($_POST['category_id']) ? $_POST['category_id'] : '' ;

        if($text && $title &&$category_id) {

            $sql = "UPDATE news SET title = '$title', text = '$text', category_id = '$category_id'   WHERE id = ".$id;

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
                <label for="">Text</label>
                <textarea name="text" id="" cols="30" rows="10" ><?= $news['text'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Category</label>
                <select name="category_id" id="" >
                    <?php foreach($categories as $value):?>
                        <option value="<?=  $value['id'] ?>" <?= $value['id'] == $news['category_id'] ? 'selected' : '' ?>><?= $value['title']?><option>
                        <?php endforeach?>
                </select>
            </div>
              
            <div class="form-group">
                <input type="hidden" name="action" value="update">
                <button class="btn submit">Update</button>
            </div>
        </form>
    </div>
</main>

<?php include('components/footer.php') ?>