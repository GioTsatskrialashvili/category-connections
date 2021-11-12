<?php include('helpers/db_connection.php') ?>

<?php include('components/header.php') ?>

<?php include('components/aside.php') ?>

<?php


// SELECT Query
$sql = "SELECT * FROM news";
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
                    <td><?= $value['title'] ?></td>
                    <td><?= $value['text'] ?></td>
                    <td><?= $value['category_id'] ?></td>
                   
                    <td class="actions">
                        <a class="edit" href="edit.php?id=<?= $value['id'] ?>">Edit</a>
                        <form action="" method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $value['id'] ?>">
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