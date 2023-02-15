<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit profile image
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
* {
  box-sizing: border-box;
}

.main {
  background-color: #262626;
  width: 100%;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.button {
  position: relative;
  display: block;
  width: 200px;
  height: 36px;
  border-radius: 18px;
  background-color: #1c89ff;
  border: solid 1px transparent;
  color: #fff;
  font-size: 18px;
  font-weight: 300;
  cursor: pointer;
  transition: all .1s ease-in-out;
  &:hover {
    background-color: transparent;
    border-color: #fff;
    transition: all .1s ease-in-out;
  }
  
}


.loader {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50px;
  height: 50px;
  background: transparent; 
  margin: 30px auto 0 auto;
  border: solid 2px #424242;
  border-top: solid 2px #1c89ff;
  border-radius: 50%;
  opacity: 0;
}

.check {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  transform: translate3d(-4px,50px,0);
  opacity: 0;
  span:nth-child(1) {
    display: block;
    width: 10px;
    height: 2px;
    background-color: #fff;
    transform: rotate(45deg);
  }
  span:nth-child(2) {
    display: block;
    width: 20px;
    height: 2px;
    background-color: #fff;
    transform: rotate(-45deg) translate3d(14px, -4px, 0);
    transform-origin: 100%;
  }
}

.loader.active {
  animation: loading 2s ease-in-out; 
  animation-fill-mode: forwards;
}

.check.active {
  opacity: 1;
  transform: translate3d(-4px,4px,0);
  transition: all .5s cubic-bezier(.49, 1.74, .38, 1.74);
  transition-delay: .2s;
}

@keyframes loading {
  30% {
    opacity:1; 
  }
  
  85% {
    opacity:1;
    transform: rotate(1080deg);
    border-color: #262626;
  }
  100% {
    opacity:1;
    transform: rotate(1080deg);
     border-color: #1c89ff;
  }
}


</style>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<div class="main">
<h1>Edit profile image</h1>

<?= form_open_multipart('dashboard/profile/profileimage/update') ?>

<div class="mb-3">
    <label for="image" class="form-label">File</label>
    <input type="file" class="form-control" name="image" id="image" />
</div>

<button type="submit" class="btn btn-primary">upload</button>
<a href="<?= base_url('dashboard/profile') ?>">Cancel</a>

<?= form_close() ?>


  <div class="loader">
    <div class="check">
      <span class="check-one"></span>
      <span class="check-two"></span>
    </div>
  </div>
  </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
  var btn = document.querySelector('.btn'),
      loader = document.querySelector('.loader'),
      check = document.querySelector('.check');
  
  btn.addEventListener('click', function () {
    loader.classList.add('active');    
  });
 
  loader.addEventListener('animationend', function() {
    check.classList.add('active'); 
  });
});

</script>

<?= $this->endSection() ?>