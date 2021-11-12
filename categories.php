<?php include('helpers/db_connection.php') ?>

<?php include('components/header.php') ?>

<?php include('components/aside.php') ?>

<?php


// SELECT Query
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
if(isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];

    $sql = "DELETE FROM categories where id = " .$id;

    if(mysqli_query($conn, $sql)) {
        header('Location:categories.php');
    } else {
        echo "Error";
    }
}
?>

<main>
    <div class="container-header">
        <h2>Categories</h2>
        <a href="form.php" class="btn">Add New</a>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>Id</th>
                <th>Title</th>
                
                
            </tr>
            <?php foreach($categories as $value): ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['title'] ?></td>
                  
                    <td class="actions">
                        <a class="edit" href="editcategory.php?id=<?= $value['id'] ?>">Edit</a>
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
    #categories-active{
        border-left: 3px solid white;
    background-color: #7e6cca;
    }
</style>