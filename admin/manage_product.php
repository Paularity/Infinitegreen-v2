<?php include 'db_connect.php' ?>
<?php
	if(isset($_GET['id'])){
        $qry = $conn->query("SELECT * FROM products as p LEFT JOIN categories as c ON p.product_cat = c.cat_id LEFT JOIN brands as b ON b.brand_id = p.product_brand WHERE p.seller_id =".$_SESSION['login_id']." AND p.product_id =".$_GET['id']." order by p.product_title ASC");	
        foreach($qry->fetch_array() as $k => $val){
            $$k=$val;
        }
    }
?>
<style>
.jqte_editor {
    min-height: 30vh !important
}

#drop {
    min-height: 15vh;
    max-height: 30vh;
    overflow: auto;
    width: calc(100%);
    border: 5px solid #929292;
    margin: 10px;
    border-style: dashed;
    padding: 10px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

#uploads {
    min-height: 15vh;
    width: calc(100%);
    margin: 10px;
    padding: 10px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

#uploads .img-holder {
    position: relative;
    margin: 1em;
    cursor: pointer;
}

#uploads .img-holder:hover {
    background: #0095ff1f;
}

#uploads .img-holder .form-check {
    display: none;
}

#uploads .img-holder.checked .form-check {
    display: block;
}

#uploads .img-holder.checked {
    background: #0095ff1f;
}

#uploads .img-holder img {
    height: 39vh;
    width: 22vw;
    margin: .5em;
}

#uploads .img-holder span {
    position: absolute;
    top: -.5em;
    left: -.5em;
}

#dname {
    margin: auto
}

img.imgDropped {
    height: 16vh;
    width: 7vw;
    margin: 1em;
}

.imgF {
    border: 1px solid #0000ffa1;
    border-style: dashed;
    position: relative;
    margin: 1em;
}

span.rem.badge.badge-primary {
    position: absolute;
    top: -.5em;
    left: -.5em;
    cursor: pointer;
}

label[for="chooseFile"] {
    color: #0000ff94;
    cursor: pointer;
}

label[for="chooseFile"]:hover {
    color: #0000ffba;
}

.opts {
    position: absolute;
    top: 0;
    right: 0;
    background: #00000094;
    width: calc(100%);
    height: calc(100%);
    justify-items: center;
    display: flex;
    opacity: 0;
    transition: all .5s ease;
}

.img-holder:hover .opts {
    opacity: 1;

}

input[type=checkbox] {
    /* Double-sized Checkboxes */
    -ms-transform: scale(1.5);
    /* IE */
    -moz-transform: scale(1.5);
    /* FF */
    -webkit-transform: scale(1.5);
    /* Safari and Chrome */
    -o-transform: scale(1.5);
    /* Opera */
    transform: scale(1.5);
    padding: 10px;
}

button.btn.btn-sm.btn-rounded.btn-sm.btn-dark {
    margin: auto;
}

img#img_path-field {
    max-height: 15vh;
    max-width: 8vw;
}
</style>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="" id="manage-product">
                    <input type="hidden" name="product_id" value="<?php echo isset($product_id) ? $product_id :'' ?>">
                    <input type="hidden" name="seller_id" value="<?php echo $_SESSION['login_id']; ?>">
                    <h4><b><?php echo !isset($id) ? "New Product" : "Manage Product" ?></b></h4>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="" class="control-label">Name</label>
                            <input type="text" class="form-control" name="product_title"
                                value="<?php echo isset($product_title) ? $product_title :'' ?>" required>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="" class="control-label">Category</label>
                            <select class="custom-select select2" name="product_cat">
                                <option value=""></option>
                                <?php
									$qry = $conn->query("SELECT * FROM categories order by cat_title asc");
									while($row=$qry->fetch_assoc()):
								?>
                                <option value="<?php echo $row['cat_id'] ?>"
                                    <?php echo isset($product_cat) && $product_cat == $row['cat_id'] ? 'selected' : '' ?>>
                                    <?php echo $row['cat_title'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="" class="control-label">Brand</label>
                            <select class="custom-select select2" name="product_brand">
                                <option value=""></option>
                                <?php
									$qry = $conn->query("SELECT * FROM brands order by brand_title asc");
									while($row=$qry->fetch_assoc()):
								?>
                                <option value="<?php echo $row['brand_id'] ?>"
                                    <?php echo isset($product_brand) && $product_brand == $row['brand_id'] ? 'selected' : '' ?>>
                                    <?php echo $row['brand_title'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label for="" class="control-label">Description</label>
                            <textarea name="product_desc" id="product_desc" class="form-control" cols="30" rows="5"
                                required><?php echo isset($product_desc) ? html_entity_decode($product_desc) : '' ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="" class="control-label">Price</label>
                            <input type="number" class="form-control text-right" name="product_price"
                                value="<?php echo isset($product_price) ? $product_price : 0 ?>">
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="" class="control-label">Stock</label>
                            <input type="number" class="form-control text-right" name="stock"
                                value="<?php echo isset($stock) ? $stock : 0 ?>">
                        </div>
                    </div>                   
                    <div class=" row form-group">
                        <div class="col-md-5">
                            <label for="" class="control-label">Product Image</label>
                            <input type="file" class="form-control" name="product_image" onchange="displayImg2(this,$(this))">
                        </div>

                        <div class="col-md-5">
                            <img src="<?php echo isset($img_fname) ? 'assets/uploads/'.$img_fname :'' ?>" alt=""
                                id="img_path-field">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-block btn-primary col-sm-2"> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="imgF" style="display: none " id="img-clone">
    <span class="rem badge badge-primary" onclick="rem_func($(this))"><i class="fa fa-times"></i></span>
</div>
<script>
// $('#payment_status').on('change keypress keyup', function() {
//     if ($(this).prop('checked') == true) {
//         $('#amount').closest('.form-group').hide()
//     } else {
//         $('#amount').closest('.form-group').show()
//     }
// })
$('.jqte').jqte();

$('#manage-product').submit(function(e) {
    e.preventDefault()
    start_load()
    $('#msg').html('')
    $.ajax({
        url: 'ajax.php?action=save_product',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully saved", 'success')
                setTimeout(function() {
                    location.href = "index.php?page=products"
                }, 1500)

            }

        }
    })
})
if (window.FileReader) {
    var drop;
    addproductHandler(window, 'load', function() {
        var status = document.getElementById('status');
        drop = document.getElementById('drop');
        var dname = document.getElementById('dname');
        var list = document.getElementById('list');

        function cancel(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            return false;
        }

        // Tells the browser that we *can* drop on this target
        addproductHandler(drop, 'dragover', cancel);
        addproductHandler(drop, 'dragenter', cancel);

        addproductHandler(drop, 'drop', function(e) {
            e = e || window.product; // get window.product if e argument missing (in IE)   
            if (e.preventDefault) {
                e.preventDefault();
            } // stops the browser from redirecting off to the image.
            $('#dname').remove();
            var dt = e.dataTransfer;
            var files = dt.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                //attach product handlers here...

                reader.readAsDataURL(file);
                addproductHandler(reader, 'loadend', function(e, file) {
                    var bin = this.result;
                    var imgF = document.getElementById('img-clone');
                    imgF = imgF.cloneNode(true);
                    imgF.removeAttribute('id')
                    imgF.removeAttribute('style')

                    var img = document.createElement("img");
                    var fileinput = document.createElement("input");
                    var fileinputName = document.createElement("input");
                    fileinput.setAttribute('type', 'hidden')
                    fileinputName.setAttribute('type', 'hidden')
                    fileinput.setAttribute('name', 'img[]')
                    fileinputName.setAttribute('name', 'imgName[]')
                    fileinput.value = bin
                    fileinputName.value = file.name
                    img.classList.add("imgDropped")
                    img.file = file;
                    img.src = bin;
                    imgF.appendChild(fileinput);
                    imgF.appendChild(fileinputName);
                    imgF.appendChild(img);
                    drop.appendChild(imgF)
                }.bindToproductHandler(file));
            }
            return false;

        });

        Function.prototype.bindToproductHandler = function bindToproductHandler() {
            var handler = this;
            var boundParameters = Array.prototype.slice.call(arguments);
            return function(e) {
                e = e || window.product; // get window.product if e argument missing (in IE)   
                boundParameters.unshift(e);
                handler.apply(this, boundParameters);
            }
        };
    });
} else {
    document.getElementById('status').innerHTML = 'Your browser does not support the HTML5 FileReader.';
}

function addproductHandler(obj, evt, handler) {
    if (obj.addproductListener) {
        // W3C method
        obj.addproductListener(evt, handler, false);
    } else if (obj.attachproduct) {
        // IE method.
        obj.attachproduct('on' + evt, handler);
    } else {
        // Old school method.
        obj['on' + evt] = handler;
    }
}

function displayIMG(input) {

    if (input.files) {
        if ($('#dname').length > 0)
            $('#dname').remove();

        Object.keys(input.files).map(function(k) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // $('#cimg').attr('src', e.target.result);
                var bin = e.target.result;
                var fname = input.files[k].name;
                var imgF = document.getElementById('img-clone');
                imgF = imgF.cloneNode(true);
                imgF.removeAttribute('id')
                imgF.removeAttribute('style')
                var img = document.createElement("img");
                var fileinput = document.createElement("input");
                var fileinputName = document.createElement("input");
                fileinput.setAttribute('type', 'hidden')
                fileinputName.setAttribute('type', 'hidden')
                fileinput.setAttribute('name', 'img[]')
                fileinputName.setAttribute('name', 'imgName[]')
                fileinput.value = bin
                fileinputName.value = fname
                img.classList.add("imgDropped")
                img.src = bin;
                imgF.appendChild(fileinput);
                imgF.appendChild(fileinputName);
                imgF.appendChild(img);
                drop.appendChild(imgF)
            }
            reader.readAsDataURL(input.files[k]);
        })

        rem_func()

    }
}

function displayImg2(input, _this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img_path-field').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function rem_func(_this) {
    _this.closest('.imgF').remove()
    if ($('#drop .imgF').length <= 0) {
        $('#drop').append('<span id="dname" class="text-center">Drop Files Here</label></span>')
    }
}
</script>