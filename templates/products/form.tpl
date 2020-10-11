<form method="post" class="form f500p" enctype="multipart/form-data">
    <input type="hidden" name="id_product" value="{$product->getId_product()}">
    
    <div class="form-element">
    <label>
        <span class="label">Название товара:</span> 
        <input type="text" name="name_product" required value="{$product->getName_product()}">
    </label>
    </div>
    <br>
    
    <div class="form-element">
    <label>
        <span class="label">Категория:</span>
        <select name="id_folder">
            
            {assign var=productFolder value=$product->getFolder()}
            {foreach from=$folders item=folder}
                <option {if $productFolder->getId_folder == $folder.id_folder}selected{/if} value="{$folder.id_folder}">{$folder.name_folder}</option>
            {/foreach}
        </select>
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Ссылка на изображение:</span> 
        <input multiple type="text" name="image_url">
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Фото товара:</span> 
        <input multiple type="file" name="images[]">
    </label>
    </div>
    {if $product->getImages()}
        <div class="form-element">
            {foreach from=$product->getImages() item=image}
            <div class="card" style="width: 45px;">
                <img src="{$image->getPath()}" class="card-img" alt="{$image->getName_image()}">
                <div class="card-body">
                    <button data-image-id="{$image->getId_image()}" onclick="return deleteImage(this)">X</button>
                    {*<form action="/products/del_image" method="POST">
                        <input type="hidden" name="id_image" value="{$image.id_image}">
                        
                    </form>*}
                </div>
            </div>
            {/foreach}
        </div>
    {literal}
        <script>
            function deleteImage(button) {
                let imageId = $(button).attr('data-image-id');
                imageId = parseInt(imageId);
                
                if (!imageId) {
                    allert('Проблема с id_image');
                    return false;
                }
                
                let url = '/products/del_image'
                
                const formData = new FormData();
                formData.append('id_image', imageId);
                
                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                        .then(() => {
                            document.location.reload();
                        });
                
                return false;        
            }
        </script>    
    {/literal}    
    {/if}    
    <br>
    <div class="form-element">
    <label>
        <span class="label">Количество:</span>  
        <input type="number" name="amount" required value="{$product->getAmount()}">
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Артикул:</span>  
        <input type="text" name="article" required value="{$product->getArticle()}">
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Цена:</span>  
        <input type="number" name="price" required value="{$product->getPrice()}">
    </label>
    </div>
    <br>
    <div class="form-element">
    <label>
        <span class="label">Описание:</span>  
        <textarea name="description" rows="6">{$product->getDescription()}</textarea>
    </label>
    </div>    
    <br>
    <input type="submit" value="{$submit_name|default:'Сохранить'}">
</form>

