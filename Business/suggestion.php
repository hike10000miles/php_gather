<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="liststyle.css">
    </head>

<?php

include "../../header.php";

require_once "connect.php";
require_once "suggestController.php";

$db = Connect::dbConnect();

$mysuggest = new Suggest($db);
$list = $mysuggest->listSuggestions();

$mysuggest = new Suggest($db);
$listBusiness = $mysuggest->listBusiness();

echo "<h2>List of Business</h2>";
foreach($listBusiness as $lb){
    echo "
        $lb->name <br/>
        <form action=\"suggestionForm.php\" method=\"post\">
        <input type=\"hidden\" value='" . $lb->id . "' name=\"id\">
        <input id='btn1' class='button' type=\"submit\" name=\"create\" value=\"Post Suggestion\" />
        </form>
        ";
}



if(isset($_GET['id'])){
    $id = $_GET['id'];
    $msg = $mysuggest->getMsg($id);
}



echo "<h2 id='list'>List of Suggestions</h2>";
echo "<table id='rounded-corner'>
        <thead>
            <tr>
                <th scope='col' class='rounded-company'>Title</th>
                <th scope='col' class='rounded-company'>Message From Admin</th>
                <th scope='col' class='rounded-company'>Action</th>
            </tr>
        </thead>
        <tbody>";
foreach ($list as $l)
{
    echo "

                    <tr>
                        <td><a href='blog.php?id=" . $l->id . "'>" . $l->title . "</a>
                        </td>
                        <td>";if($l->Reply == null)
                        {
                            echo "No message";
                        }else {
                            echo $l->Reply;
}
                        echo "</td>
                        <td id='rowbtn'><form action=\"deleteSuggestAdmin.php\" method=\"post\">
                            <input type=\"hidden\" value='" . $l->id . "' name=\"id\">
                            <input id='btn1' class='button' type=\"submit\" name=\"delete\" value=\"Delete\" onClick=\"javascript: return confirm('Do you really want to delete this?');\"/>
                            </form>
                         
                            <form action=\"updateSuggest.php\" method=\"post\">
                            <input type=\"hidden\" value='" . $l->id . "' name=\"id\">
                            <input id='btn2' class='button' type=\"submit\" name=\"update\" value=\"Update\">
                            </form>
                        </td>
                        
                    </tr>
                
    ";
}
echo "</tbody></table>";

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
?>

<br/>
<br/>
<form action="suggestionForm.php" method="post">
    <input type="submit" name="add" value="Create Suggestion">
</form>

<?php

include "../../footer.php";
?>