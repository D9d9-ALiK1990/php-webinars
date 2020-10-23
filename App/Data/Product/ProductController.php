<?php

namespace App\Data\Product;

use App\Http\Request;
//use App\Product\ProductService;
use App\Data\Product\ProductRepositoryOld;
use App\Http\Response;
use App\Renderer\Renderer;
use App\Data\FolderService;
use App\Data\Folder\FolderModel;
//use App\ProductImageService;
use App\Data\Product\ProductModel;
use App\Router\Route;
use App\Controller\AbstractController;

class ProductController extends AbstractController{
    
//    /**
//     *
//     * @var Route 
//     */
//    private $route;
    
    public function __construct() {
 //       $this->route = $route;
    }
    
    /**
     * 
     * @param Request $request
     * @param ProductRepositoryOld $productRepository
     * 
     * @route("/product_list")
     */
    public function list(Request $request, ProductRepositoryOld $productRepository) {
        
//        $request = new Request();
        $current_page = $request->getIntFromGet('p', 1);
        $limit = 10;
        $offset = ($current_page - 1)*$limit;


        $products_count = $productRepository->get_Spisok_Count();
        $pagesCount = ceil($products_count / $limit);

    //    $productRepository = new ProductRepositoryOld();
        $products = $productRepository->get_Spisok($limit, $offset);
        
    return $this->render('products/products.tpl', [
        'pages_count' => $pagesCount,
        'products' => $products,
    ]);

//        Renderer::getSmarty()->assign('pages_count', $pages_count);
//        Renderer::getSmarty()->assign('products', $products);
//        Renderer::getSmarty()->display('products/products.tpl');
    }
    
    public function upd(Request $request, ProductRepositoryOld $productRepository, ProductService $productService,
                        ProductImageService $productImageService, Response $response, FolderService $folderService) {
        
        $id_product = $request->getIntFromGet('id_product', null);
        if (is_null($id_product)) {
            $id_product = $this->route->getParam('id_product');
        }
        $product = [];

//        $productRepository = new Product\ProductRepositoryOld();

        if ($id_product) {
            $product = $productRepository->getById($id_product);    
        } 

        if ($request->isPost()) {
        //    $id_product = $_POST['id_product'] ?? '';
        //    $name_product = $_POST['name_product'] ?? '';
        //    $amount = $_POST['amount'] ?? '';
        //    $article = $_POST['article'] ?? '';
        //    $price = $_POST['price'] ?? '';
        //    $description = $_POST['description'] ?? '';
        //    $id_folder = $_POST['id_folder'] ?? '';

        $productData = $productService->getDataFromPost($request);

        $product->setName_product($productData['name_product']);
        $product->setArticle($productData['article']);
        $product->setAmount($productData['amount']);
        $product->setPrice($productData['price']);
        $product->setDescription($productData['description']);

        $id_folder = $productData['id_folder'] ?? 0;
        //echo var_dump($id_folder);
        //    exit;
            if ($id_folder) {
                $folderData = $folderService->get_By_Id($id_folder);
                $name_folder = $folderData['name_folder'];

                $folder = new FolderModel($name_folder);
                $folder->setId_folder($id_folder);

                $product->setFolder($folder);
            }

        //$updated = Product::update_By_Id($id_product, Product::getDataFromPost());

        $product = $productRepository->save($product);

        $imageUrl = trim($_POST['image_url']);
        $productImageService->uploadImageByUrl($id_product, $imageUrl);
        $uploadImages = $_FILES['images'] ?? [];
        $productImageService->uploadImages($id_product, $uploadImages);

        return $this->redirect('/products');

        }
        $folders = $folderService->get_Spisok();
        return $this->render('products/upd.tpl', [
        'folders' => $folders,
        'product' => $product,
    ]);
        
//        Renderer::getSmarty()->assign('folders', $folders);
//        Renderer::getSmarty()->assign('product', $product);
//        Renderer::getSmarty()->display('products/upd.tpl');
    }
    
    public function add(Request $request, ProductRepositoryOld $productRepository, ProductService $productService,
                        ProductImageService $productImageService, Response $response, FolderService $folderService) {
        
        if ($request->isPost())   {
        $productData = $productService->getDataFromPost($request);
//        $productRepository = new Product\ProductRepositoryOld();
        $product = $productRepository->getProductFromArray($productData);
        //echo var_dump($product);
        //exit;

        $product = $productRepository->save($product);
        //echo var_dump($product);
        //exit;
        $id_product = $product->getId_product();

        $imageUrl = trim($request->getStrFromPost('image_url'));

        $productImageService->uploadImageByUrl($id_product, $imageUrl);

        $uploadImages = $_FILES['images'] ?? [];

        $productImageService->uploadImages($id_product, $uploadImages);



            if ($id_product) {
                return $this->redirect('/products');
            }
            else {
                die("ne proshlo");
            }
        }
        $folders = $folderService->get_Spisok();

// Костыль        
        $product = new ProductModel('', 0, 0);
        $product->setId_product(0);
        
        $folder = new FolderModel('');
        $folder->setId_folder(0);
        $product->setFolder($folder);
        
        return $this->render('products/add.tpl', [
        'folders' => $folders
    ]);
//        Renderer::getSmarty()->assign('folders', $folders);
//        Renderer::getSmarty()->display('products/add.tpl');
    }
    
    public function del(Request $request, ProductService $productService, Response $response) {
        $id_product = $request->getIntFromPost('id_product', false);

        if (!$id_product) {
            die("poshlo ne tak");
        }
        (int)$id_product; 

        $deleted = $productService->delete_By_Id($id_product);
        if ($deleted) {
            return $this->redirect('/products');
        }
    //    echo "<pre>"; var_dump($this); echo "</pre>"; exit;
        else {
            die("ne proshlo");
            }
    }

    public function del_image(Request $request, ProductImageService $productImageService) {
        $id_image = $request->getIntFromPost('id_image');

        if (!$id_image) {
            die("udalenie image poshlo ne tak");
        }
        (int) $id_image; 
        $productImageService->delete_By_Id($id_image);
        //if ($deleted) {
        //    Response::redirect('/products/products');
        //}
        //else {
        //    die("ne proshlo");
        //}

    }
}
