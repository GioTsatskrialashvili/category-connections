<?php include('helpers/db_connection.php') ?>

<?php include('components/header.php') ?>

<?php include('components/aside.php') ?>

<?php


// SELECT Query
$sql = "SELECT news.id as news_id, news.title as news_title, news.text, news.category_id, categories.id as cat_id, categories.title as category_title 
FROM news
 INNER JOIN categories ON news.category_id = categories.id";
$result = mysqli_query($conn, $sql);
$news = mysqli_fetch_all($result, MYSQLI_ASSOC);





if(isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];

    $sql = "DELETE FROM news where id = " .$id;

    if(mysqli_query($conn, $sql)) {
        header('Location:index.php');
    } else {
        echo "Error";
    }
}
?>

<main>
    <div class="container-header">
        <h2>News</h2>
        <a href="newsform.php" class="btn">Add New</a>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>Title</th>
                <th>Text</th>
                <th>Category ID</th>
                
            </tr>
            <?php foreach($news as $value): ?>
                <tr>
                    <td><?= $value['news_title'] ?></td>
                    <td><?= $value['text'] ?></td>
                    <td><?= $value['category_title'] ?></td>
                   
                    <td class="actions">
                        <a class="edit" href="edit.php?id=<?= $value['news_id'] ?>">Edit</a>
                        <form action="" method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $value['news_id'] ?>">
                            <button class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
    </div>
</main>

<?php include('components/footer.php') ?>
<style>
    #news-active{
        border-left: 3px solid white;
    background-color: #7e6cca;
    }
</style>