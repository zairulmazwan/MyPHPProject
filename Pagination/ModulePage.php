<?php 
require("../HeaderNav.php");

// Variables
$table_name = "Module";
$rows_per_page = 5;

// Pagination: Current Page
$page  = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $rows_per_page;

// DB Query
$db = new SQLite3('C:\xampp\Data\StudentModule.db');
$sql = "SELECT * FROM $table_name LIMIT $start, $rows_per_page";
$result = $db->query($sql);

// Pagination: Total pages
$count_rows = $db->query("SELECT COUNT(*) FROM $table_name")->fetchArray()[0];
$total_pages = ceil($count_rows / $rows_per_page);


?>



	<div class="container bgColor">
        <main role="main" class="pb-5">
		<h2>Module Page</h2>

        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <?php for ($i = 0; $i < $result->numColumns(); $i++) : ?>
                                <th><?php echo $result->columnName($i); ?></th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)) : ?>
                            <tr>
                                <?php foreach ($row as $key => $value) : ?>
                                <td><?php echo $value; ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php if ($total_pages > 1) : ?>
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($page > 1) : ?>
                        <li class="page-item">
                            <a href="ModulePage.php?page=<?php echo $page - 1; ?>"  class="page-link">Previous</a>
                        </li>
                        <?php else: ?>
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <?php if ($i == $page) : ?>
                        <li class="page-item active">
                            <span class="page-link"><?php echo $i; ?></span>
                        </li>
                        <?php else: ?>
                        <li class="page-item">
                            <a href="ModulePage.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                        </li>
                        <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages) : ?>
                        <li class="page-item">
                            <a href="ModulePage.php?page=<?php echo $page + 1; ?>" class="page-link">Next</a>
                        </li>
                        <?php else: ?>
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php endif; ?>


		</main>
	</div>

<?php require("../Footer.php");?>


