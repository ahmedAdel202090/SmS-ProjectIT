function submitForm(id)
{
  document.getElementById("board_id").value=id;
  document.forms["table_form"].submit();
}
$(document).ready(function(){
  $("#form_add").submit(function(event)
  {
    event.preventDefault();
    var name=getElementByName("boardName").value;
    if(name=="")
    {
        alert("please fill board name");
    }
    else{
        var formData=$("#form_add").serialize();
        $.ajax({
          url:$("#form_add").attr("action"),
          type:'POST',
          data:formData,
          success:function()
          {
          }
      });
    }
  }
  );
   
 $("#delete_form").submit(function(event)
  {
        event.preventDefault();
        var formData=$("#delete_form").serialize();
        $.ajax({
          url:$("#delete_form").attr("action"),
          type:'POST',
          data:formData,
          success:function()
          {
          }
      });
  }

  );




})