<style> 
.input {
	color:grey;
	margin:2px;
}
label {
	margin:5px;
	width:100px; 
	height:50px;
}
</style>


<div style="text-align:center;">
	<h2> Add a new blog to the database </h2>  
	<form action='http://192.168.0.38:8888/framework/blog/add/1' method='post'>
		<div>
			<label> Blog Name :</label> <input class='input' type='text' name='blog[name]' value='New blog name' /> <br /> 
			<label> Blog Title :</label> <input class='input' type='text' name='blog[title]' value='New blog title' /> <br />
			<label> Blog Category :</label> <input class='input' type='text' name='blog[category]' value='New blog category' /> <br />
			<label> Blog Content :</label> <textarea class='input' type='text' name='blog[content]'>new blog content</textarea> <br />
			<input type='submit' />
		</div>
	</form>

</div>
