<?php

namespace App\Repositories;

use App\Interfaces\DevelopmentRepositoryInterface;
use App\Models\Event;
use App\Models\Development;
use Exception;
use Illuminate\Support\Facades\DB;

class DevelopmentRepository implements DevelopmentRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    ) {
        $query = Development::where(function ($query) use ($search) {
            if ($search) {
                // jika ada parameter search maka akan melakukan search yang didefinisikan di model user
                $query->search($search);
            }
        });

        $query->orderBy('created_at', 'desc');
        if ($limit) {
            // take -> mengambil data berdasarkan limit
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage
    ) {
        $query = $this->getAll(
            $search,
            $rowPerPage,
            false,
        );
        return $query->paginate($rowPerPage);
    }

    public function getById(
        string $id
    ) {
        $query = Development::where('id', $id);
        return $query->first();
    }

    public function create(
        array $data
    ) {
        // jika ada kesalahan data maka data tidak otomatis keinput
        DB::beginTransaction();

        try {
            $event = Development::where('id', $data['event_id'])->first();

            $development  = new Development;
            $development->event_id = $data['event_id'];
            $development->head_of_family_id = $data['head_of_family_id'];
            $development->quantity = $data['quantity'];
            $development->total_price = $event->price * $data['quantity'];
            $development->payment_status = "pending";

            $development->save();

            DB::commit();

            return $development;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function update(
        string $id,
        array $data
    ) {
        // jika ada kesalahan data maka data tidak otomatis keinput
        DB::beginTransaction();

        try {
            $event = Event::where('id', $data['event_id'])->first();

            $development = Development::find($id);
            $development->event_id = $data['event_id'];
            $development->head_of_family_id = $data['head_of_family_id'];

            if (isset($data['quantity'])) {
                $development->quantity = $data['quantity'];
            } else {
                $data['quantity'] = $development->quantity;
            }
            $development->total_price = $event->price * $data['quantity'];
            if (isset($data['payment_status'])) {
                $development->payment_status = $data['payment_status'];
            } else {
                $data['payment_status'] = $development->payment_status;
            }

            $development->save();

            DB::commit();

            return $development;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function delete(
        string $id
    ) {
        DB::beginTransaction();

        try {
            $development = Development::find($id);

            $development->delete();

            DB::commit();

            return $development;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }
}
