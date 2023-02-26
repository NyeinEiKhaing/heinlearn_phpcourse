<?php
    include "layouts/nav.php"
?>
<style>
    .btn{
        float:right;
    }
</style>

<div class="container bg-danger my-5 rounded">
    <h2 class="text-center pt-3">Contact Us</h2>
    <div class="row">
        <div class="col-md-5 my-5">
            <div class="form">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-success mb-3">Send</button>
            </div>
        </div>
        <div class="col-md-6 my-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59212.98380541701!2d96.0922461!3d21.9417974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb73a14c3ffe49%3A0xd84ae396e68343bf!2sCentral%20Point!5e0!3m2!1sen!2smm!4v1675927186800!5m2!1sen!2smm" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

<?php
    include "layouts/footer.php"
?>