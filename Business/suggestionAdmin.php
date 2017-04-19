<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../user/liststyle.css">
</head>

<?php

include "../../header.php";

require_once "../user/connect.php";
require_once "../user/suggestController.php";

$db = Connect::dbConnect();

$mysuggest = new Suggest($db);
$list = $mysuggest->listSuggestions();

echo "<h1>List of Suggestions</h1>";

echo "<table id='rounded-corner'>
<thead>
<tr>
<th scope='col' class='rounded-company'>Title</th>
<th scope='col' class='rounded-company'>UserName</th>
<th scope='col' class='rounded-company'>Action</th>
</tr>
</thead>";
foreach ($list as $l)
{
    echo "
                <tbody>
                    <tr>
                        <td><a href='index.php?id=" . $l->id . "'>" . $l->title . "</a></td>
                    
                        <td>$l->first_name $l->last_name</td>
                        <td id='rowbtn'><form action=\"deleteSuggestAdmin.php\" method=\"post\">
                            <input type=\"hidden\" value='" . $l->id . "' name=\"id\">
                            <input id='btn1' class='button' type=\"submit\" name=\"delete\" value=\"Delete\" onClick=\"javascript: return confirm('Do you really want to delete this?');\"/>
                            </form>
                            <form action=\"suggestionReplyAdmin.php\" method=\"post\">
                            <input type=\"hidden\" value='" . $l->id . "' name=\"id\">
                            <input id='btn2' class='button' type=\"submit\" name=\"reply\" value=\"Reply\">
                            </form>
                            </td>
                    </tr>
                </tbody>
          
    ";
}

echo "</table>";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $details = $mysuggest->getDetails($id);
}

if(isset($details))
{
    echo "<h2>Suggestion Details</h2>";
    echo "<b>Title: </b>" . $details->title . "<br/>";
    echo "<b>Date: </b>" . $details->date . "<br/>";
    echo "<b>Suggestion: </b>" . $details->suggest;
}

include "../../footer.php";
?>