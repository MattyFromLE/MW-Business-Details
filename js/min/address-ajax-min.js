jQuery(document).ready(function($){function e(e){$.ajax({type:"GET",url:a,dataType:"text",data:{action:"new_business_address",addressName:e},beforeSend:function(){},success:function(e){$(".business_addresses").append(e),$("#new_business_address").val(""),$(".business-save input").prop("disabled",!0)},error:function(){}})}function s(e){$.ajax({type:"GET",url:a,data:{action:"delete_business_address",id:e},beforeSend:function(){},success:function(s){$("#"+e).remove()},error:function(){}})}var a=address_ajax_params.ajax_url;$("input.address-name").change(function(){var e=$(this).closest(".address-wrapper"),s=e.attr("id"),a=e.find("input");a.each(function(){var e=$(this).attr("name").replace(s,$("input.address-name").val()).toLowerCase();$(this).attr("name",e.replace(/ /g,"-"))}),$(this).closest(".address-wrapper").attr("id",$(this).val().replace(/ /g,"-").toLowerCase())}),$("body").on("click","#addNewAddress",function(s){s.preventDefault();var a=$(this).parentsUntil("tr").find("input").val();""!=a?e(a):alert("Enter an Address Name First")}),$("body").on("click","#deleteAddress",function(e){e.preventDefault();var a=$(this).closest(".address-wrapper").attr("id");s(a)}),$("body").on("blur",".new-address input",function(e){var s=!0;$(".new-address input").each(function(){s=s&&""!==$(this).val()}),s&&$(".business-save input").prop("disabled",!1)})});