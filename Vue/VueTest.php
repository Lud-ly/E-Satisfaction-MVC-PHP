<script src="assets/js/pages/test.js"></script>
<link rel="stylesheet" href="assets/css/test.css">

<h1>Test</h1>
<div class="form">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">Never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <?php $instanceVue->getPartieHtml('Test', 'ajoutTest'); ?>
</div>