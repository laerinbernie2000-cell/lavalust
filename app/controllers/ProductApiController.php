
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('ProductModel');
    }

    private function authenticate()
    {
        $this->api->require_jwt();
    }

    public function index()
    {
        $this->authenticate();
        $products = $this->ProductModel->getAll();
        $this->api->respond($products);
    }

    public function store()
    {
        $this->authenticate();
        $data = $this->api->body();

        $name = trim($data['product_name'] ?? '');
        $price = $data['price'] ?? null;
        $quantity = $data['quantity'] ?? null;

        if ($name === '' || strlen($name) > 100 ||
            !is_numeric($price) || $price < 0 ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false ||
            $quantity < 0) {
            $this->api->respond_error('Invalid product data', 422);
            return;
        }

        $this->ProductModel->create([
            'product_name' => $name,
            'description' => $data['description'] ?? '',
            'price' => $price,
            'quantity' => $quantity,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $this->api->respond(['message' => 'Product added'], 201);
    }

    public function update($id)
    {
        $this->authenticate();

        if (!$this->ProductModel->getById($id)) {
            $this->api->respond_error('Product not found', 404);
            return;
        }

        $data = $this->api->body();
        $updates = [];

        if (array_key_exists('product_name', $data)) {
            $name = trim($data['product_name']);
            if ($name === '' || strlen($name) > 100) {
                $this->api->respond_error('Invalid product name', 422);
                return;
            }
            $updates['product_name'] = $name;
        }

        if (array_key_exists('description', $data)) {
            $updates['description'] = $data['description'];
        }

        if (array_key_exists('price', $data)) {
            if (!is_numeric($data['price']) || $data['price'] < 0) {
                $this->api->respond_error('Invalid price', 422);
                return;
            }
            $updates['price'] = $data['price'];
        }

        if (array_key_exists('quantity', $data)) {
            if (filter_var($data['quantity'], FILTER_VALIDATE_INT) === false ||
                $data['quantity'] < 0) {
                $this->api->respond_error('Invalid quantity', 422);
                return;
            }
            $updates['quantity'] = $data['quantity'];
        }

        if (!$updates) {
            $this->api->respond_error('No fields to update', 422);
            return;
        }

        $this->ProductModel->updateProduct($id, $updates);
        $this->api->respond(['message' => 'Product updated']);
    }

    public function destroy($id)
    {
        $this->authenticate();

        if (!$this->ProductModel->getById($id)) {
            $this->api->respond_error('Product not found', 404);
            return;
        }

        $this->ProductModel->deleteProduct($id);
        $this->api->respond(['message' => 'Product deleted']);
    }
}
