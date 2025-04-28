<?php
function showobjects($objectvar)
{
    echo "<pre>";
    print_r($objectvar);
    echo "</pre>";
}

function success($value)
{
    echo "<div class=absolute z--50 top-4 left-4 bg-blue-500 text-white p-4 rounded-lg shadow-lg'>";
    echo  "<h3 class='text-green-900 text-lg font-semibold'>$value</h3></div";

}
function error($value)
{
    echo  "<h3 style='color:red'>$value</h3>";
}

function btnFunctionality($pdo, $action, $query, $successMessage)
{
    if (isset($_POST["$action"])) {
        
        if ($action === "insert") {
            $credential = [ 'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'course' => $_REQUEST['course'],];
        } elseif ($action === "delete") {
            $credential = ['id' => $_REQUEST['id'],];
        }
        else{
            $credential = [
                'id' => $_REQUEST['id'],
                'name' => $_REQUEST['name'],
                'email' => $_REQUEST['email'],
                'course' => $_REQUEST['course'],
            ];
        }
        try {
            $stmt = $pdo->prepare($query);
            $stmt->execute($credential);
            showDataInTable($pdo);
            success($successMessage);
        } catch (PDOException $e) {
            error($e->getMessage());
        }
    }
}


function showDataInTable($pdo)
{
    try {
        $stmt = $pdo->query("select * from students");
        $students = $stmt->fetchAll(PDO::FETCH_BOTH);
?>
<div class="bg-white p-6 rounded-xl shadow-md overflow-x-auto">
<h2 class="text-2xl font-bold text-gray-800 mb-4">Student List</h2>
<table class="min-w-full text-sm text-left text-gray-500">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-6">ID</th>
                        <th class="py-3 px-6">Name</th>
                        <th class="py-3 px-6">Email</th>
                        <th class="py-3 px-6">Course</th>
                        <th class="py-3 px-6">Actions</th>
                        <th class="py-3 px-6">Remove</th>
                    </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($students as $value): ?>
                    <form method="post">
                        <tr>
                            <td class="py-3 overflow-hidden px-4 max-w-[20px]"><input type="text" value="<?= htmlspecialchars($value['ID']) ?>" name="id" readonly></td>
                            <td class="py-3 overflow-hidden px-4 max-w-[120px]"><input type="text" value="<?= htmlspecialchars($value['NAME']) ?>" name="name"></td>
                            <td class="py-3 overflow-hidden px-4"><input type="text" value="<?= htmlspecialchars($value['EMAIL']) ?>" name="email"></td>
                            <td class="py-3 overflow-hidden px-4 max-w-[120px]"><input type="text" value="<?= htmlspecialchars($value['COURSE']) ?>" name="course"></td>
                            <td class=" overflow-hidden  bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500"><input type="submit" value="Update" name="update"></td>
                            <td class=" overflow-hidden  bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"><input type="submit" value="Delete" name="delete"></td>
                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

</div>
<?php
    } catch (PDOException $e) {
        error($e);
    }
}