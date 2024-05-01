<?php
    include "src/controllers/locales/get_locales.php";
    $locales = get_locales();
    $locales2 = get_locales();
?>

<style>

@keyframes slide {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-100%);
  }
}

.logos {
  overflow: hidden;
  padding: 25px 0;
  background: white;
  white-space: nowrap;
  position: relative;
}

.logos:before,
.logos:after {
  position: absolute;
  top: 0;
  width: 5rem;
  height: 100%;
  content: "";
  z-index: 2;
}

.logos:before {
  left: 0;
  background: linear-gradient(to left, rgba(255, 255, 255, 0), white);
}

.logos:after {
  right: 0;
  background: linear-gradient(to right, rgba(255, 255, 255, 0), white);
}

.logos:hover .logos-slide {
  animation-play-state: paused;
}

.logos-slide {
  display: inline-block;
  animation: 35s slide infinite linear;
}

.logos-slide img {
  height: 7rem;
  margin: 0 12px;
}
</style>

<div class="logos">
    <div class="logos-slide">
        <?php
        while($local = mysqli_fetch_array($locales)){ 
        ?>
            <a href="local/<?php echo $local['cod_local']; ?>" style="text-decoration: none;">
                <img src="<?php echo $local['url_logo']?>" alt="<?php echo $local['nombre_local']?>">
            </a>
        <?php }?>
    </div>

    <div class="logos-slide">
        <?php
        while($local = mysqli_fetch_array($locales2)){ 
        ?>
            <img src="<?php echo $local['url_logo']?>" alt="<?php echo $local['nombre_local']?>">
        <?php }?>
    </div>
    
</div>

