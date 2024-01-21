function changeView() {
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");


}

// screem size //


// window.addEventListener("resize", function() {
//     var screenWidth = window.innerWidth;
//     // var screenHeight = window.innerHeight;



//     var form = new FormData();

//     // form.append("st", searchText);
//     // form.append("ss", searchSelect);
//     form.append("Ssize", screenWidth);

//     var r = new XMLHttpRequest();

//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {
//             var t = r.responseText
//                 // alert(t);

//             // document.getElementById("basicSearchResult").innerHTML = t;
//             // if (screenWidth < 1000) {
//             //     document.getElementById("screen-size").innerHTML = t;

//             // } else {

//             //     document.getElementById("screen-size").innerHTML = " ";
//             // }

//             if (screenWidth < 1000) {
//                 document.getElementById("cartproduc").innerHTML = t;
//             } else {

//                 document.getElementById("cartproduc").innerHTML = t;
//             }

//         }
//     };

//     r.open("POST", "homeproductcartProcess.php", true);
//     r.send(form);


//     // document.getElementById("screen-size").innerHTML = `Screen size: ${screenWidth} x ${screenHeight}`;
// });

// screem size //

// capslock


var capsLocksAnimation = 0;
var capsLockstatus = 0;


function capsLock3() {

    document.getElementById("password").addEventListener("click", m1);
    document.getElementById("password").addEventListener("keyup", m1);

    document.getElementById("Rpassword").addEventListener("click", m2);
    document.getElementById("Rpassword").addEventListener("keyup", m2);

    document.getElementById("SiPassword").addEventListener("click", m3);
    document.getElementById("SiPassword").addEventListener("keyup", m3);

    if (capsLockstatus == 0) {

        capsLocksAnimation = setInterval(hidediv, 5000);
        capsLockstatus = 1;
    }
}

function hidediv() {

    var popup1 = document.getElementById("myPopup1");
    var popup2 = document.getElementById("myPopup2");
    var popup3 = document.getElementById("myPopup3");

    popup1.className = "hi";
    popup2.className = "hi";
    popup3.className = "hi";

    if (capsLockstatus == 1) {
        clearInterval(capsLocksAnimation);
        capsLockstatus = 0;
    }
}

function m1(event) {

    var caps = event.getModifierState("CapsLock");

    if (caps == true) {

        var popup2 = document.getElementById("myPopup2");
        popup2.className = "show";

    } else {
        var popup2 = document.getElementById("myPopup2");
        popup2.className = "hi";

    }
}

function m2(event) {

    var caps = event.getModifierState("CapsLock");

    if (caps == true) {

        var popup3 = document.getElementById("myPopup3");
        popup3.className = "show";

    } else {
        var popup3 = document.getElementById("myPopup3");
        popup3.className = "hi";

    }
}


function m3(event) {

    var caps = event.getModifierState("CapsLock");

    if (caps == true) {

        var popup1 = document.getElementById("myPopup1");
        popup1.className = "show";

    } else {
        var popup1 = document.getElementById("myPopup1");
        popup1.className = "hi";

    }
}


// capslock


function signUp() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var Rpassword = document.getElementById("Rpassword");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");




    var form = new FormData();

    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("Rpassword", Rpassword.value);
    form.append("mobile", mobile.value);
    form.append("gender", gender.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                document.getElementById("fn").innerHTML = "";
                document.getElementById("ln").innerHTML = "";
                document.getElementById("em").innerHTML = "";
                document.getElementById("p").innerHTML = "";
                document.getElementById("rp").innerHTML = "";
                document.getElementById("mo").innerHTML = "";

                // document.getElementById("change").click();
                // document.getElementById("signUpreset").reset();
                window.location = "index.php";


            } else {

                if (t == "Please enter your first name" || t == "first name must be less than 30 characters") {
                    document.getElementById("fn").innerHTML = t;
                    fname.className = "error";

                    if (gender.value >= 1) {

                        gender.className = "true";

                    } else {

                        gender.className = "form-style";
                    }

                    document.getElementById("ln").innerHTML = "";
                    document.getElementById("em").innerHTML = "";
                    document.getElementById("p").innerHTML = "";
                    document.getElementById("rp").innerHTML = "";
                    document.getElementById("mo").innerHTML = "";

                } else if (t == "Please enter your last name" || t == "last name must be less than 30 characters") {
                    document.getElementById("fn").innerHTML = "";
                    fname.className = "true";
                    document.getElementById("ln").innerHTML = t;
                    lname.className = "error";

                    if (gender.value >= 1) {

                        gender.className = "true";

                    } else {

                        gender.className = "form-style";
                    }

                    document.getElementById("em").innerHTML = "";
                    document.getElementById("p").innerHTML = "";
                    document.getElementById("rp").innerHTML = "";
                    document.getElementById("mo").innerHTML = "";

                } else if (t == "Please enter your email" || t == "Email must be less than 100 characters" || t == "Invalid email Address" || t == "already used in this email. try again.") {

                    document.getElementById("ln").innerHTML = "";
                    lname.className = "true";
                    document.getElementById("fn").innerHTML = "";
                    fname.className = "true";
                    document.getElementById("em").innerText = t;
                    email.className = "error";

                    if (gender.value >= 1) {

                        gender.className = "true";

                    } else {

                        gender.className = "form-style";
                    }

                    document.getElementById("p").innerHTML = "";
                    document.getElementById("rp").innerHTML = "";
                    document.getElementById("mo").innerHTML = "";

                } else if (t == "Please enter your password" || t == "password length should be between 6 to 20") {
                    document.getElementById("em").innerHTML = "";
                    email.className = "true";
                    document.getElementById("fn").innerHTML = "";
                    fname.className = "true";
                    document.getElementById("ln").innerHTML = "";
                    lname.className = "true";
                    document.getElementById("p").innerHTML = t;
                    password.className = "error";

                    if (gender.value >= 1) {

                        gender.className = "true";

                    } else {

                        gender.className = "form-style";
                    }

                    document.getElementById("rp").innerHTML = "";
                    document.getElementById("mo").innerHTML = "";

                } else if (t == "Please enter your ReType-password" || t == "Password & Retype-password does not match") {
                    document.getElementById("p").innerHTML = "";
                    password.className = "true";
                    document.getElementById("fn").innerHTML = "";
                    fname.className = "true";
                    document.getElementById("ln").innerHTML = "";
                    lname.className = "true";
                    document.getElementById("em").innerHTML = "";
                    email.className = "true";
                    document.getElementById("rp").innerHTML = t;
                    Rpassword.className = "error";

                    if (gender.value >= 1) {

                        gender.className = "true";

                    } else {

                        gender.className = "form-style";
                    }

                    document.getElementById("mo").innerHTML = "";

                } else if (t == "please enter your mobile Number" || t == "mobile number should contain 10 charachters" || t == "Invalid Mobile Number" || t == "Please Select your gender" ||
                    t == "already used in this Mobile Number. try again.") {

                    document.getElementById("rp").innerHTML = "";
                    Rpassword.className = "true";
                    document.getElementById("fn").innerHTML = "";
                    fname.className = "true";
                    document.getElementById("ln").innerHTML = "";
                    lname.className = "true";
                    document.getElementById("em").innerHTML = "";
                    email.className = "true";
                    document.getElementById("p").innerHTML = "";
                    password.className = "true";
                    document.getElementById("mo").innerHTML = t;

                    if (t == "please enter your mobile Number" || t == "mobile number should contain 10 charachters" || t == "Invalid Mobile Number" ||
                        t == "already used in this Mobile Number. try again.") {

                        mobile.className = "error";

                        if (gender.value >= 1) {

                            gender.className = "true";

                        } else {

                            gender.className = "form-style";
                        }

                    } else if (t == "Please Select your gender") {

                        mobile.className = "true";
                        gender.className = "error";
                    }

                }

            }
        }
    };

    r.open("POST", "SignUpProcess.php", true);
    r.send(form);


}

function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("SiPassword");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();

    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberMe", rememberMe.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                document.getElementById("Sem").innerHTML = "";
                document.getElementById("Sp").innerHTML = "";

                window.location = "home.php";
            } else {
                if (t == "Please enter your email" || t == "Invalid email Address") {
                    // document.getElementById("ln").innerHTML = "";
                    // lname.className = "true";
                    // document.getElementById("fn").innerHTML = "";
                    // fname.className = "true";
                    document.getElementById("Sem").innerHTML = t;
                    email.className = "error";

                    document.getElementById("Sp").innerHTML = "";

                } else if (t == "Please enter your password" || t == "Please Check your Password") {
                    document.getElementById("Sem").innerHTML = "";
                    email.className = "true";

                    document.getElementById("Sp").innerHTML = t;
                    password.className = "error";


                } else if (t == "Invalid Email Or Password") {
                    document.getElementById("Sp").innerHTML = "";
                    password.className = "error";

                    document.getElementById("Sem").innerHTML = t;
                    email.className = "error";
                }
            }
        }
    };


    r.open("POST", "SignInProcess.php", true);
    r.send(form);

}

function changeImage() {

    var image = document.getElementById("profileimg");
    var view = document.getElementById("prev0");

    image.onchange = function() {


        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;

    }

}

// alert
function customAlert() {
    // display custom dialog box
    document.getElementById("custom-dialog").style.display = "block";

    // add event listeners to custom buttons
    document.getElementById("custom-yes").addEventListener("click", function() {
        // alert("You clicked Yes");
        document.getElementById("custom-dialog").style.display = "none";
    });
    document.getElementById("custom-no").addEventListener("click", function() {
        // alert("You clicked No");
        document.getElementById("custom-dialog").style.display = "none";
    });
}

// call customAlert function to display custom dialog box


// alert


function updateProfile() {


    var view = document.getElementById("prev0").src;
    var Efilename = view.substring(view.lastIndexOf('/') + 1);
    // alert(Efilename)

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var addressline1 = document.getElementById("addline1");
    var addressline2 = document.getElementById("addline2");
    var province = document.getElementById("provi_Reg");
    var district = document.getElementById("dist_Reg");
    var city = document.getElementById("usercity");
    // var pstcode = document.getElementById("pstcode");
    var image = document.getElementById("profileimg");


    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("a1", addressline1.value);
    form.append("a2", addressline2.value);
    form.append("c", city.value);
    form.append("Eimg", Efilename);
    form.append("province", province.value);
    form.append("district", district.value);
    // form.append("pstcode", pstcode.value);
    form.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var text = r.responseText;
            // alert(text)

            if (text == "Choose a profile picture if you want.") {

                document.getElementById("custom-dialog").style.display = "block";
                document.getElementById("customAlert").innerText = text;

                // add event listeners to custom buttons
                document.getElementById("custom-yes").addEventListener("click", function() {
                    // alert("You clicked Yes");
                    document.getElementById("custom-dialog").style.display = "none";
                    document.getElementById("imgbutton").focus();
                });
                document.getElementById("custom-no").addEventListener("click", function() {
                    // alert("You clicked No");
                    document.getElementById("custom-dialog").style.display = "none";

                    alert("Your Profile is Updated.");
                    location.reload();
                });


            } else if (text == "Profile Image Updated Successfully" || text == "Profile Image Saved Successfully") {

                alert(text);
                location.reload();

            } else {

                alert("Your Profile is Updated.");
                location.reload();



            }

        }
    };

    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);

}


function changeProductImg1() {

    var image = document.getElementById("imageUploder1");
    var view = document.getElementById("prev1");

    image.onchange = function() {


        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;

    }

}

function changeProductImg2() {

    var image = document.getElementById("imageUploder2");
    var view = document.getElementById("prev2");

    image.onchange = function() {


        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;

    }

}

function changeProductImg3() {

    var image = document.getElementById("imageUploder3");
    var view = document.getElementById("prev3");

    image.onchange = function() {


        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;

    }

}

function hideProduct(id) {

    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            if (r.responseText == 'success') {
                alert("Product Was Deleted Successfuly");
                location.reload();
            } else {
                alert(r.responseText);
            }


        }

    };
    r.open("POST", "hideProduct.php", true);
    r.send(f);
}




function addProduct() {

    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");

    var condition = 0;

    if (document.getElementById("bn").checked) {

        condition = 1;

    } else if (document.getElementById("us").checked) {

        condition = 2;
    }

    var color = 0;

    if (document.getElementById("clr1").checked) {

        color = 1;

    } else if (document.getElementById("clr2").checked) {

        color = 2;

    } else if (document.getElementById("clr3").checked) {

        color = 3;

    } else if (document.getElementById("clr4").checked) {

        color = 4;

    } else if (document.getElementById("clr5").checked) {

        color = 5;

    } else if (document.getElementById("clr6").checked) {

        color = 6;

    }


    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image1 = document.getElementById("imageUploder1");
    var image2 = document.getElementById("imageUploder2");
    var image3 = document.getElementById("imageUploder3");

    // if (imageCount == 1) {

    //     form.append("img1", image1);


    // } else if (imageCount == 2) {

    //     form.append("img1", image1);
    //     form.append("img2", image2);

    // } else if (imageCount == 3) {

    //     form.append("img1", image1);
    //     form.append("img2", image2);
    //     form.append("img3", image3);

    // }




    var f = new FormData();
    f.append("c", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("co", condition);
    f.append("col", color);
    f.append("qty", qty.value);
    f.append("p", price.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("desc", description.value);
    f.append("img1", image1.files[0]);
    f.append("img2", image2.files[0]);
    f.append("img3", image3.files[0]);



    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var text = r.responseText;

            if (text == "Success") {
                alert(text);
                document.location.reload();

            } else {
                document.getElementById("msg").innerHTML = text;
                alert(text);
                document.location.reload();
            }


        }

    };

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}

function loadmainimg(id) {

    var pid = id;

    var img = document.getElementById("pimg" + pid).src;
    var mainimg = document.getElementById("mainimg");

    mainimg.style.backgroundImage = "url(" + img + ")";


}



function chngstatus(id) {


    var prodcutId = id;
    var statusChange = document.getElementById("flexSwitchCheckChecked");
    var statusLabel = document.getElementById("checkLable" + prodcutId);
    var status;
    if (statusChange.checked) {
        status = 1;
    } else {
        status = 0;
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Activated") {
                statusLabel.innerHTML = "Make Your Product Active";
                statusLabel.className = "form-check-label text-danger";
            } else {
                statusLabel.innerHTML = "Make Your Product Deacive";
                statusLabel.className = "form-check-label text-info";

            }
        }
    };
    r.open("GET", "statusChangeProcess.php?p=" + prodcutId + "&s=" + status, true);
    r.send();

}

function addFilters(page) {


    var search = document.getElementById("s");
    var age;
    if (document.getElementById("n").checked) {

        age = 1;

    } else if (document.getElementById("o").checked) {

        age = 2;

    } else {
        age = 0;
    }


    var qty;
    if (document.getElementById("l").checked) {
        qty = 1;
    } else if (document.getElementById("h").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var condition;
    if (document.getElementById("b").checked) {

        condition = 1;

    } else if (document.getElementById("u").checked) {

        condition = 2;

    } else {
        condition = 0;
    }

    var form = new FormData();
    form.append("s", search.value);
    form.append("a", age);
    form.append("q", qty);
    form.append("c", condition);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = r.responseText;
        }

    };
    if (page != null) {
        r.open("POST", "sortProcess.php?page=" + page, true);
    } else {
        r.open("POST", "sortProcess.php", true);
    }

    r.send(form);
}

function clearfilters() {
    window.location = "myProducts.php";
}

function sendId(id) {

    var idl = id;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "updateproduct.php";
            }
        }
    };
    r.open("GET", "sendProductProcess.php?id=" + idl, true);
    r.send();
}

var selectedColor;

function colorCheck(id) {
    selectedColor = id;
}

var selectedbrand;

function brandCheck(id) {
    selectedbrand = id;

}


var imageCount = 0;

var image1;
var image2;
var image3;

function clearPreview() {
    for (x = 1; x <= 3; x++) {
        document.getElementById("prev" + x).src = "resources/addproductimg.svg";
    }
}

function changeProductImg(type) {
    if (type == "update" && imageCount == 0) {
        clearPreview();
    }
    var image = document.getElementById("imageUploader");

    image.onchange = function() {
        if (imageCount == 0) {

            var view = document.getElementById("prev1");
            var img1 = this.files[0];
            image1 = img1;
            var url = window.URL.createObjectURL(img1);
            view.src = url;

        } else if (imageCount == 1) {

            var view = document.getElementById("prev2");

            var img2 = this.files[0];
            image2 = img2;
            var url = window.URL.createObjectURL(img2);
            view.src = url;

        } else if (imageCount == 2) {
            var view = document.getElementById("prev3");
            var img3 = this.files[0];
            image3 = img3;
            var url = window.URL.createObjectURL(img3);
            view.src = url;

        } else if (imageCount > 2) {
            alert("Only 3 images for a product");
        }
        imageCount += 1;

    }

}


function updateProduct() {

    if (selectedColor == null) {
        var defcolor = document.getElementById("fallback").innerHTML;
        selectedColor = defcolor;
    }

    if (selectedbrand == null) {
        var defcondition = document.getElementById("confallback").innerHTML;
        selectedbrand = defcondition;
    }
    var title = document.getElementById('ti');
    var qty = document.getElementById('qty');
    var cost = document.getElementById('cost');
    var delivery_within_colomo = document.getElementById('dwc');
    var delivery_out_of_colomo = document.getElementById('doc');
    var description = document.getElementById('desc');


    var form = new FormData();
    form.append('t', title.value);
    form.append('qty', qty.value);
    form.append('c', cost.value);
    form.append('dwc', delivery_within_colomo.value);
    form.append('doc', delivery_out_of_colomo.value);
    form.append('desc', description.value);
    form.append('clr', selectedColor);
    form.append('con', selectedbrand);

    if (imageCount == 1) {

        form.append("img1", image1);


    } else if (imageCount == 2) {

        form.append("img1", image1);
        form.append("img2", image2);

    } else if (imageCount == 3) {

        form.append("img1", image1);
        form.append("img2", image2);
        form.append("img3", image3);

    }

    form.append("imageCount", imageCount);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            var f = t.trim();
            if (f == 'success') {
                alert("Product Updated Successfuly");
                window.location = 'myProducts.php';
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(form);

}



//product block//

function ProductBlock(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            if (r.responseText == "Product Unblocked") {

                document.getElementById("btn" + id).className = "btn btn-danger";
                document.getElementById("btn" + id).innerHTML = "Block";
            } else if (r.responseText == "Product Blocked") {
                document.getElementById("btn" + id).className = "btn btn-warning";
                document.getElementById("btn" + id).innerHTML = "unblock";
            }
        }
    };
    r.open("GET", "productBlock.php?id=" + id, true);
    r.send();
}


var mm;

function viewsgmodal(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("msgBody").innerHTML = r.responseText;
            document.getElementById("other").innerHTML = id;
        }
    }
    r.open("GET", "viewAdminMessage.php?id=" + id, true);
    r.send();


    var m = document.getElementById("viewmsgmodal");
    var mm = new bootstrap.Modal(m);
    mm.show();
}

var pm;

function viewProductModal(id) {

    var am = document.getElementById("viewproductmodal" + id);
    pm = new bootstrap.Modal(am);

    pm.show();
}


var cm;

function addNewCategory() {
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var cvm;
var newCategory;
var uemail;

function categoryVerifyModal() {

    var mine = document.getElementById("addCategoryModelVerification");
    cvm = new bootstrap.Modal(mine);

    newCategory = document.getElementById("n").value;
    uemail = document.getElementById("e").value;

    var f = new FormData();
    f.append("n", newCategory);
    f.append("e", uemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = () => {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (r.responseText == "success") {
                alert("Email Has Been Sent Successfully. Please Check Your email");
                cm.hide();
                cvm.show();
            } else {
                alert(text);
            }

        }
    };
    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);


}

function saveCategory() {
    var verification = document.getElementById("vtext").value;
    Category = document.getElementById("n").value;
    uemail = document.getElementById("e").value;

    var f = new FormData();
    f.append("t", verification);
    f.append("c", Category);
    f.append("e", uemail);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                alert("Category Registerd Successfuly");
                window.location = "manageProducts.php";
            } else {
                alert(text);
            }
        }
    }
    r.open("POST", "saveNewCategoryProcess.php", true);
    r.send(f);
}

function changeInvoiceId(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var btn = document.getElementById("btn" + id);
            if (r.responseText == 1) {
                btn.className = "btn btn-warning mb-2 mt-2 fw-bold";
                btn.innerHTML = "Packing";
            } else if (r.responseText == 2) {
                btn.className = "btn btn-info mb-2 mt-2 fw-bold";
                btn.innerHTML = "Dispatch";
            } else if (r.responseText == 3) {
                btn.className = "btn btn-primary mb-2 mt-2 fw-bold";
                btn.innerHTML = "Shipping";
            } else if (r.responseText == 4) {
                btn.className = "btn btn-danger mb-2 mt-2 fw-bold";
                btn.innerHTML = "Delivered";
            }
        }
    };
    r.open("GET", "changeinvoiceIDprocess.php?id=" + id, true);
    r.send();
}

function removecategory(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success") {

                alert("category was removed successfully ");

                window.location = "manageProducts.php";

            } else {

                alert(text);
            }

        }
    };


    r.open("GET", "removecaregoryprocess.php?id=" + id, true);
    r.send();

}

// add  model brand//

function addCbm() {

    window.location = "manageProducts.php";

}

// brand

var bm;

function addNewbrand() {
    var m = document.getElementById("addBrandModal");
    bm = new bootstrap.Modal(m);
    bm.show();
}

var bvm;
var newBrand;
var buemail;

function brandVerifyModal() {

    var mine = document.getElementById("addbrandModelVerification");
    bvm = new bootstrap.Modal(mine);

    newBrand = document.getElementById("bn").value;
    buemail = document.getElementById("be").value;


    var f = new FormData();
    f.append("n", newBrand);
    f.append("e", buemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = () => {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (r.responseText == "success") {
                alert("Email Has Been Sent Successfully. Please Check Your email");
                bm.hide();
                bvm.show();
            } else {
                alert(text);

            }

        }
    };
    r.open("POST", "addNewbrandProcess.php", true);
    r.send(f);


}


function savebrand() {
    var verification = document.getElementById("bvtext").value;
    Category = document.getElementById("bn").value;
    uemail = document.getElementById("be").value;

    var f = new FormData();
    f.append("t", verification);
    f.append("c", Category);
    f.append("e", uemail);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                alert("Brand Registerd Successfuly");
                window.location = "manageProducts.php";
            } else {
                alert(text);
            }
        }
    }
    r.open("POST", "saveNewbrandProcess.php", true);
    r.send(f);
}


function removebrand(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success") {

                alert("brand was removed successfully ");

                window.location = "manageProducts.php";

            } else {

                alert(text);
            }

        }
    };


    r.open("GET", "removebrandprocess.php?id=" + id, true);
    r.send();

}

// brand

// model



var mm;

function addNewmodel() {
    var m = document.getElementById("addmodelModal");
    mm = new bootstrap.Modal(m);
    mm.show();
}

var mvm;
var newModel;
var muemail;

function modelVerifyModal() {

    var mine = document.getElementById("addmodelModelVerification");
    mvm = new bootstrap.Modal(mine);

    newModel = document.getElementById("mn").value;
    muemail = document.getElementById("me").value;

    var f = new FormData();
    f.append("n", newModel);
    f.append("e", muemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = () => {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (r.responseText == "success") {
                alert("Email Has Been Sent Successfully. Please Check Your email");
                mm.hide();
                mvm.show();
            } else {
                alert(text);
            }

        }
    };
    r.open("POST", "addNewmodelProcess.php", true);
    r.send(f);


}


function savemodel() {
    var verification = document.getElementById("mvtext").value;
    Category = document.getElementById("mn").value;
    uemail = document.getElementById("me").value;

    var f = new FormData();
    f.append("t", verification);
    f.append("c", Category);
    f.append("e", uemail);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                alert("model Registerd Successfuly");
                window.location = "manageProducts.php";
            } else {
                alert(text);
            }
        }
    }
    r.open("POST", "saveNewmodelProcess.php", true);
    r.send(f);
}


function removemodel(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success") {

                alert("model was removed successfully ");

                window.location = "manageProducts.php";

            } else {

                alert(text);
            }

        }
    };


    r.open("GET", "removemodelprocess.php?id=" + id, true);
    r.send();
}
// model



// colour



var clm;

function addNewcolour() {
    var m = document.getElementById("addmodelcolour");
    clm = new bootstrap.Modal(m);
    clm.show();
}

var clvm;
var newColour;
var cluemail;

function colourVerifyModal() {

    var mine = document.getElementById("addcolourModelVerification");
    clvm = new bootstrap.Modal(mine);

    newColour = document.getElementById("cln").value;
    cluemail = document.getElementById("cle").value;

    var f = new FormData();
    f.append("n", newColour);
    f.append("e", cluemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = () => {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (r.responseText == "success") {
                alert("Email Has Been Sent Successfully. Please Check Your email");
                clm.hide();
                clvm.show();
            } else {
                alert(text);
            }

        }
    };
    r.open("POST", "addNewColourProcess.php", true);
    r.send(f);


}


function savecolour() {
    var verification = document.getElementById("clvtext").value;
    Category = document.getElementById("cln").value;
    uemail = document.getElementById("cle").value;

    var f = new FormData();
    f.append("t", verification);
    f.append("c", Category);
    f.append("e", uemail);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                alert("Colour Registerd Successfuly");
                window.location = "manageProducts.php";
            } else {
                alert(text);
            }
        }
    }
    r.open("POST", "saveNewColourProcess.php", true);
    r.send(f);
}


function removecolour(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success") {

                alert("Colour was removed successfully ");

                window.location = "manageProducts.php";

            } else {

                alert(text);
            }

        }
    };


    r.open("GET", "removecolourprocess.php?id=" + id, true);
    r.send();
}
// model



// add category model brand



//admin verification//


function adminVerification() {
    var email = document.getElementById("email");

    var adminpwfield = document.getElementById("adminpwfield");
    var vscode = document.getElementById("vscode");
    var sendlogin = document.getElementById("sendlogin");
    var f = new FormData();

    f.append("e", email.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            t = r.responseText;

            if (t == "Succes") {


                adminpwfield.classList.remove('adminpwBl');
                adminpwfield.classList.add('adminpwNoBl');
                vscode.removeAttribute('disabled');
                email.setAttribute('readonly', true);
                vscode.focus();
                sendlogin.innerHTML = 'Sign In';
                sendlogin.addEventListener("click", verify);
                sendlogin.onclick = null

                // var verificationModal = document.getElementById("veificationModel");

                // xm = new bootstrap.Modal(verificationModal);
                // xm.show();
            } else {

                alert(t);

            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);

}



function changeStatus(id) {

    var productId = id;
    var statusChange = document.getElementById("flexSwitchCheckChecked");
    var statusLable = document.getElementById("checkLable" + productId);


    var status;

    if (statusChange.checked) {

        status = 1;
    } else {

        status = 0;
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Deactivated") {

                statusLable.innerHTML = "Make your product Active";

            } else if (text == "Activated") {

                statusLable.innerHTML = "Make your product Deactive";
            }

        }
    };


    r.open("GET", "statusChangeProcess.php?p=" + productId + "&s=" + status, true);
    r.send();

}



function verify() {
    var vscode = document.getElementById("vscode");
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            t = r.responseText;
            if (t == "success") {

                window.location = "adminpannel.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "verifyProcess.php?id=" + vscode.value, true);
    r.send();
}


//admin verification//

// Contact Model

function ContactModel() {



    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 

    modal.style.display = "block";


    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

// Contact Model


//  search

// Advance search
function advancedsearch(x) {


    var searchtxt = document.getElementById("s1");
    var category = document.getElementById("ca1");
    var brand = document.getElementById("br1");
    var model = document.getElementById("mo1");
    var condition = document.getElementById("co1");
    var colour = document.getElementById("col1");
    var priceFrom = document.getElementById("pf1");
    var PriceTo = document.getElementById("pt1");
    var sort = document.getElementById("sort");



    var form = new FormData();

    form.append("page", x);
    form.append("s", searchtxt.value);
    form.append("ca", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("con", condition.value);
    form.append("col", colour.value);
    form.append("pf", priceFrom.value);
    form.append("pt", PriceTo.value);
    form.append("sort", sort.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);

            document.getElementById("results").innerHTML = t;

        }

    };

    r.open("POST", "advanceSearchProcess.php", true);
    r.send(form);

}

//basic search



function basicSearch(x) {


    var searchText = document.getElementById("basic_search_txt").value;
    var searchSelect = document.getElementById("basic_search_select").value;

    var form = new FormData();

    form.append("st", searchText);
    form.append("ss", searchSelect);
    form.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText
                // alert(t);

            document.getElementById("basicSearchResult").innerHTML = t;

        }
    };

    r.open("POST", "basicsearchProcess.php", true);
    r.send(form);

}


function myFunction() {
    var x = document.getElementById("maindiv");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}


//  search


function buy() {

    alert("Please Sign in first");

}




//single product view qty


function qty_inc(qty, id) {

    var qty1 = qty;

    var input = document.getElementById("qtyinput" + id);

    if (input.value < qty1) {
        var newvalue = parseInt(input.value) + 1;
        input.value = newvalue.toString();
    } else {
        alert("Maximum quantity Has Achived.");
    }

}

function qty_dec(id) {

    var input = document.getElementById("qtyinput" + id);

    if (input.value > 1) {
        var newvalue = parseInt(input.value) - 1;
        input.value = newvalue.toString();
    } else {
        alert("Minimum Quantity has Achived");
    }
}


function check_val(qty, id) {


    // var input = document.getElementById("qtyinput" + id);
    var input = document.getElementById("qtyinput" + id);
    // var qtyelements = document.getElementsByClassName("qty");




    if (input.value > qty) {
        alert("Insuficient Qyantity");
        input.value = qty;
    } else if (input.value < 1) {
        alert("Insuficient Qyantity");
        input.value = 1;
    }
}

//single product view qty

function deleteFromCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                // alert("Product Added to the Recent Successfully");
                alert("Product Removed from the Cart Successfully")
                window.location = "cart.php";
            }
        }
    };

    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();

}
//Cart//

// watchlist

function addToWatchlist(id) {

    var wid = id;
    var icon = document.getElementById("heart" + id);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("New product has added to the watchlist")
                icon.style.backgroundColor = "#097fec";

                // window.location.reload();

            } else if (t == "success2") {
                alert(" product has removed to the watchlist")
                icon.style.backgroundColor = "#6c757e";

                // window.location.reload();
            } else {
                alert(t);
            }

        }
    };

    r.open("get", "addToWatchlistProcess.php?id=" + wid, true);
    r.send();

}

function Watchlist() {
    alert("Please Sign in first");
}


function deleteFromWatchlist(id) {

    var pid = id;


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {

                window.location = "watchlist.php";
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "deleteWatchlistProcess.php?id=" + pid, true);
    r.send();
}

// watchlist

//SIIGN OUT


function signOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "Home.php";
            }
        }
    };

    r.open("GET", "signOutProcess.php", true);
    r.send();
}

//admin signout

function adminsignout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {

                window.location = "adminsignin.php";
            }
        }
    };

    r.open("GET", "signOutProcess.php", true);
    r.send();
}

//SIIGN OUT

//Cart//
// var cardidArray = [];


function addToCart(id) {

    // cardidArray.push(id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Please Sign in first.") {
                alert(t);
                window.location = "http://localhost/FutureTech/index.php";

            } else {
                alert(t);
            }
        }
    }





    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();

}

function readdToCart(id) {

    // cardidArray.push(id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Please Sign in first.") {
                // alert(t);
                window.location = "http://localhost/FutureTech/index.php";

            } else {
                // alert(t);
                document.location.reload();
            }
        }
    }


    r.open("GET", "remaddToCartProcess.php?id=" + id, true);
    r.send();

}




function TyaddToCart(id) {


    var input = document.getElementById("qtyinput" + id);
    // cardidArray.push(id);
    // alert(input.value)
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Please Sign in first.") {
                // alert(t);
                window.location = "http://localhost/FutureTech/index.php";

            } else {
                alert(t);
                document.location.reload();
            }
        }
    }


    r.open("GET", "typaddToCartProcess.php?id=" + id + "&input=" + input.value, true);
    r.send();

}

function dwnaddToCart(id) {

    // cardidArray.push(id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Please Sign in first.") {
                // alert(t);
                window.location = "http://localhost/FutureTech/index.php";

            } else {
                // alert(t);
                document.location.reload();
            }
        }
    }


    r.open("GET", "dwnaddToCartProcess.php?id=" + id, true);
    r.send();

}



// function buycartall(arr) {
//     alert(cardidArray)
// }



function buyProduct(id) {

    var qty = document.getElementById("qtyinput" + id).value;

    var unit_price = document.getElementById("unitprice" + id).innerHTML;

    var f = new FormData();
    f.append("pid", id);
    f.append("pqty", qty);
    f.append("uprice", unit_price);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "product Ok") {
                window.location = "checkout.php";
            } else if (t == "profile not updated") {
                alert("Please Update Your Addess In Profile");
                window.location = "userprofile.php";
            } else if (t == "user not signed in") {
                alert("Please Log In First");
                window.location = "index.php";
            } else if (t == "invalid qty") {
                alert("Invalid Quantity");
            } else if (t == "invalid price") {
                alert(t);
            } else {
                alert(t);
                //   alert("Error Occured Please Try Refreshing The Browser");
            }

        }
    }

    r.open("POST", "checkProduct.php", true);
    r.send(f);
}


function directToInvoice(id) {

    window.location = "invoice.php?order_id=" + id;
}


function printInvoice() {

    var restorePage = document.body.innerHTML;

    var page = document.getElementById("page").innerHTML;

    document.body.innerHTML = ` <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">` + page;
    window.print();

    document.body.innerHTML = restorePage;
}

function directToInvoice(id) {

    window.location = "invoice.php?order_id=" + id;
}

function cartdirectToInvoice(id) {

    window.location = "cartinvoice.php?order_id=" + id;
}

function backtoHome() {
    window.location = "home.php";
}

function deleteFromPHistory(id) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            if (r.responseText == "success") {
                alert("Product Was Deleted Successfully");
                window.location = "purchaseHistory.php";
            } else {
                alert(r.responseText);
            }
        }
    }
    r.open("GET", "deleteFromPurchaseHistory.php?id=" + id, true);
    r.send();
}


function clearAllPurshase() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            if (r.responseText == "success") {
                alert("ALL Reocrds Deleted");
                window.location = "purchaseHistory.php";
            } else {
                alert(r.responseText);
            }
        }
    }
    r.open("GET", "deleteAllPurchaseHistroy.php", true);
    r.send();
}

var fm;

function showFeedbackModel(id, name, inid) {

    document.getElementById('pid').innerHTML = id;
    document.getElementById('ptitle').innerHTML = name;
    document.getElementById('trid').innerText = inid;
    var verificationModal = document.getElementById("veificationModel");
    fm = new bootstrap.Modal(verificationModal);
    fm.show();
}

startCount = 0;

function markStar(count) {
    for (i = 1; i < 6; i++) {
        if (i <= count) {
            document.getElementById('star' + i).style.color = "rgb(237, 205, 21)";
        } else {
            document.getElementById('star' + i).style.color = "black";
        }

    }
    startCount = count;
}

function addfeedback() {
    var id = document.getElementById('pid').innerHTML;
    if (startCount == 0) {
        alert("Please Select Reating");
    } else {
        var feed = document.getElementById('feed').value;
        var inid = document.getElementById('trid').innerHTML;
        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                if (r.responseText == "success") {
                    alert("Feedback Added Successfuly Thank You");
                    fm.hide();
                } else {
                    alert(r.responseText);
                }
            }
        }
        r.open("GET", "addFeedbackProcess.php?id=" + id + "&count=" + startCount + "&feed=" + feed + "&inid=" + inid, true);
        r.send();
    }

}

function resetPurchaseModal() {
    document.getElementById('feed').value = "";
    startCount = 0;
    document.getElementById('ptitle').innerHTML = "";
    for (i = 1; i < 6; i++) {

        document.getElementById('star' + i).style.color = "black";


    }
}

function userBlock(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            if (r.responseText == "User Unblocked") {
                document.getElementById("btn" + id).className = "btn btn-danger";
                document.getElementById("btn" + id).innerHTML = "Block";
            } else if (r.responseText == "User Blocked") {
                document.getElementById("btn" + id).className = "btn btn-warning";
                document.getElementById("btn" + id).innerHTML = "unblock";
            }
        }
    };
    r.open("GET", "userBlock.php?id=" + id, true);
    r.send();
}

function directToAddProduct() {
    window.location = "addproduct.php";
}

function viewSellings() {
    var fromDate = document.getElementById("fdate");
    var ToDate = document.getElementById("tdate");

    window.location = "sellingHistory.php?fdate=" + fromDate.value + "&tdate=" + ToDate.value;




}

function searchSelling() {
    var fdate = document.getElementById("fromDate").value;
    var tdate = document.getElementById("toDate").value;
    var id = document.getElementById("searchid").value;
    if (id == "" && fdate == "" && tdate == "") {
        window.location = "sellingHistory.php";
    } else {
        var f = new FormData();
        f.append("fdate", fdate);
        f.append("tdate", tdate);
        f.append("id", id);
        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                if (r.responseText != "none") {
                    document.getElementById("items").innerHTML = r.responseText;
                }

            }
        }


        r.open("POST", "searchSellingHostroy.php", true);
        r.send(f);
    }

}

function checkOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "product Ok") {

                window.location = "cartcheckout.php";
            } else {
                alert(t)
            }

        }
    }
    r.open("GET", "buyCartprocess.php", true);
    r.send();
}
let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');

}


// window.onscroll = () => {
//     navbar.classList.remove('active');

// }



function load_district() {

    var provi = document.getElementById("provi_Reg").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("dist_Reg").innerHTML = t;

        }
    };

    r.open("GET", "loadDistrict.php?p=" + provi, true);
    r.send();

}

function downloadPdf() {

    window.location = "sendinvoic.php";

}