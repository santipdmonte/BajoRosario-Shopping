<div>

                <div class="card" style="width: 15rem;">
                    <img src="<?php echo $promo['url_logo']?>" class="card-img-top" alt="...">
                    <div href="#" class="card-body">
    
                        <div style="display: flex; justify-content: space-between;">
                            <h5 class="card-title"><?php echo $promo['texto_promo']?></h5>
                            <div>
                                <span class="badge text-bg-info"><?php echo $promo['categoria_cliente']?></span>
                            </div>
                        </div>
    
                        <h6 class="card-subtitle mb-2 text-body-secondary">
                            <a href="local/<?php echo $promo['cod_local']; ?>" style="color: black">
                                <?php echo $promo['nombre_local']?>
                            </a>
                        </h6>
    
                        <h6 class="card-subtitle mb-2 text-body-secondary">Hasta el <?php echo $promo['fecha_hasta_promo']?></h6>
    
                        <?php $dias_semana = json_decode($promo['dias_semana']); ?>
                        <div class="d-flex gap-1">
                            <p class="rounded d-flex justify-content-center <?php echo $dias_semana[0]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">L</p>
                            <p class="rounded d-flex justify-content-center <?php echo $dias_semana[1]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">M</p>
                            <p class="rounded d-flex justify-content-center <?php echo $dias_semana[2]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">M</p>
                            <p class="rounded d-flex justify-content-center <?php echo $dias_semana[3]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">J</p>
                            <p class="rounded d-flex justify-content-center <?php echo $dias_semana[4]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">V</p>
                            <p class="rounded d-flex justify-content-center <?php echo $dias_semana[5]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">S</p>
                            <p class="rounded d-flex justify-content-center <?php echo $dias_semana[6]? 'bg-success' : 'bg-secondary';?>" style="width:19px;">D</p>                                   
                        </div>
    
                        <?php if (isset($_SESSION['user'])){?>
                            <form action="/bajorosario-shopping/src/controllers/promociones/promo_uso.php" method="POST">
                                <input type="text" name="cod_promo" value="<?php echo $promo['cod_promo']?>" hidden>
                                <input type="text" name="cod_usuario" value="<?php echo $_SESSION['cod_usuario']?>" hidden>
                                <button type="submit" class="btn btn-primary w-100" name="use_promo">Obtener Promoción</button>
                            </form>
                        <?php }?>
    
                    </div>
                </div>
            </div>