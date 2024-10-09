<?php 

declare(strict_types=1);

namespace Carefy\Mvc\Controller;

use Carefy\Mvc\Entity\censo;
use Carefy\Mvc\Repository\censoRepository;

class CensoListController implements Controller
{

  
    public function __construct(private CensoRepository $repository)
    {
        
    }
    public function processaRequisicao(): void{

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10; // Registros por página
        $totalRecords = $this->repository->countAll();
        $totalPages = ceil($totalRecords / $limit);
        
        $censos = $this->repository->getAll();
        
        include __DIR__ . '/../../views/MenuInicial.php';

    }
}