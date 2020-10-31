var discoverUrl = "./json/discoverJson.php";

fetch(discoverUrl)
.then( (data) => console.log(data.json()));