<?php

namespace App\RealWorld\Transformers;

use Illuminate\Support\Collection;
use App\RealWorld\Paginate\Paginate;

abstract class Transformer
{
    /**
     * Resource name of the json object.
     *
     * @var string
     */
    protected $resourceName = 'data';

    /**
     * Transform a collection of items.
     *
     * @param Collection $data
     * @return array
     */
    public function collection(Collection $data)
    {
        return [
            str_plural($this->resourceName) => $data->map([$this, 'transform'])
        ];
    }

    /**
     * Transform a single item.
     *
     * @param $data
     * @return array
     */
    public function item($data)
    {
        return [
            $this->resourceName => $this->transform($data)
        ];
    }

    /**
     * Transform a paginated item.
     *
     * @param Paginate $paginated
     * @return array
     */
    public function paginate(Paginate $paginated)
    {
        $resourceName = str_plural($this->resourceName);

        $countName = str_plural($this->resourceName) . 'Count';

        $data = [
            $resourceName => $paginated->getData()->map([$this, 'transform'])
        ];

        return array_merge($data, [
            $countName => $paginated->getTotal()
        ]);
    }

    /**
     * Get uploaded files url.
     *
     * @return string
     */
    public function publicFilesUrl() {
        return url('/') . '/files/';
    }

    /**
     * Get role data.
     *
     * @param array $data)
     * @return array
     */
    public function getRole($data) {
        $role = [];
        if ($data) {
            $role = [
                'name'       => $data['name'],
                'is_admin'   => $data['is_admin']
            ];
        }
        return $role;
    }

    /**
     * Get file data.
     *
     * @param array $data)
     * @return array
     */
    public function getFile($data) {
        $file = [];
        if ($data) {
            $file = [
                'name'       => $data['name'],
                'slug'       => $this->publicFilesUrl() . $data['slug']
            ];
        }
        return $file;
    }

    /**
     * Apply the transformation.
     *
     * @param $data
     * @return mixed
     */
    public abstract function transform($data);
}
