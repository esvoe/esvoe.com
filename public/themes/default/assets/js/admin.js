$(document).ready(function(){
	

	$('.announce-delete').on('click',function(e){
      e.preventDefault();     
      ancremove_btn = $(this).closest('.announce-delete'); 
      announcement_id = $(this).data('announcement-id');
      $.confirm({
        title: 'Confirm!',
        content: 'Do you want to delete announcemnt?',
        confirmButton: 'Yes',
        cancelButton: 'No',
        confirmButtonClass: 'btn-primary',
        cancelButtonClass: 'btn-danger',

        confirm: function(){
        	$.post(SP_source() + 'ajax/announce-delete', {announcement_id: announcement_id}, function(data) {
        		if (data.status == 200) 
        		{
        			if (data.announce == true) 
        			{
        				ancremove_btn.closest('tr').hide();
        			} 
        		}
        	});
       },
       cancel: function(){

       }
     });

    });

  $('.category-delete').on('click',function(e){
      e.preventDefault();     
      ancremove_btn = $(this).closest('.category-delete'); 
      category_id = $(this).data('categorie-id');
      $.confirm({
        title: 'Confirm!',
        content: 'Do you want to delete category?',
        confirmButton: 'Yes',
        cancelButton: 'No',
        confirmButtonClass: 'btn-primary',
        cancelButtonClass: 'btn-danger',

        confirm: function(){
          $.post(SP_source() + 'ajax/category-delete', {category_id: category_id}, function(data) {
            if (data.status == 200) 
            {
              if (data.category == true) 
              {
                ancremove_btn.closest('tr').hide();
              } 
            }
          });
       },
       cancel: function(){

       }
     });

    }); 

    
});