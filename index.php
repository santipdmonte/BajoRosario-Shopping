<?php include("src/views/header.php")?>

<?php  include ('src/views/hero_section.html')?>

<style>
    body {
  background: #f2f2f2;
}
</style>

<!-- TODO: Carusel de Marcas -->
<?php include('src/views/marcas_carousel.php')?>

<section class="text-center p-5" >
    <h3 class="bold text-xl fs-1" style="text-shadow: 0.5px 0.5px 1px rgba(0, 0, 0, 0.5);">180+ TIENDAS</h3>
    <p class="bold">El mejor shopping de Rosario</p>
</section>

<?php include('src/views/promociones_slider.php')?>

<?php include('src/views/index_section_tiendas.php')?>

<?php include 'src/views/whatsapp_float.html'?>

<?php include("src/views/footer.html")?>