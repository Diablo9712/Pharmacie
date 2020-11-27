var url=window.location.href;
    url=url.toLowerCase();
if(url.search('product.php')!=-1)
{
var i=0;
var url_img  = document.querySelector('#url_img');
//show img befor upload 
url_img.addEventListener('change', function (evt) {
    previewFile();
});
//this function 
    function previewFile() {
        var preview = document.querySelector('#p_sh');
        var file    = document.querySelector('#url_img').files[0];
        var reader  = new FileReader();
        reader.addEventListener("load", function () {
          preview.src = reader.result;
        }, false);
      
        if (file) {
            reader.readAsDataURL(file);
        }
        
    }
}