<?php $__env->startSection('titulo', 'Catálogo de Perfumes'); ?>
<?php $__env->startSection('conteudo'); ?>

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h3>Catálogo de Perfumes</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?php echo e(url('perfume/create')); ?>" class="btn btn-success">+ Novo Perfume</a>
        </div>
    </div>

    <form action="<?php echo e(route('perfume.search')); ?>" method="post" class="mb-4">
        <?php echo csrf_field(); ?>
        <div class="row g-2">
            <div class="col-md-3">
                <select name="tipo" class="form-select">
                    <option value="nome">Nome</option>
                    <option value="marca">Marca</option>
                    <option value="preco">Preço</option>
                </select>
            </div>
            <div class="col-md-7">
                <input type="text" name="valor" placeholder="Pesquisar por perfume, marca..." class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php $__currentLoopData = $dados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col">
                <div class="card h-100 border shadow-sm">
                    <div class="bg-light text-center py-4 border-bottom">
                        <span class="fs-1">Imagem 👍</span>
                    </div>

                    <!-- Detalhes do Produto -->
                    <div class="card-body d-flex flex-column">
                        <small class="text-muted text-uppercase fw-bold"><?php echo e($item->marca); ?></small>
                        <h5 class="card-title my-1"><?php echo e($item->nome); ?></h5>
                        
                        <div class="mb-3">
                            <span class="badge bg-secondary"><?php echo e($item->familia_olfativa); ?></span>
                            <small class="text-muted ms-1"><?php echo e($item->volume); ?>ml</small>
                        </div>

                        <div class="mt-auto pt-2">
                            <span class="fs-6 text-muted">Preço:</span>
                            <h4 class="text-success fw-bold mb-0">R$ <?php echo e(number_format((float)$item->preco, 2, ',', '.')); ?></h4>
                        </div>
                    </div>

                    <!-- Ações de Gerenciamento -->
                    <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between gap-2 pb-3">
                        <a class="btn btn-sm btn-outline-warning w-50" title="Editar" href="<?php echo e(route('perfume.edit', $item->id)); ?>">Editar</a>
                        
                        <form action="<?php echo e(route('perfume.destroy', $item->id)); ?>" method="post" class="w-50 m-0">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100" title="Excluir"
                                onclick="return confirm('Deseja realmente excluir este perfume?')">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Mensagem de lista vazia -->
    <?php if($dados->isEmpty()): ?>
        <div class="alert alert-info mt-4">
            Nenhum perfume encontrado no catálogo.
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\joaob\Downloads\pweb2_2026_2-main\pweb2_2026_2-main\resources\views/perfume/list.blade.php ENDPATH**/ ?>