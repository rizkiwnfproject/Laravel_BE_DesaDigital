<?php

namespace App\Repositories;

use App\Interfaces\EventParticipantRepositoryInterface;
use App\Models\EventParticipant;
use Exception;
use Illuminate\Support\Facades\DB;

class EventParticipantRepository implements EventParticipantRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    ) {
        $query = EventParticipant::where(function ($query) use ($search) {
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
        $query = EventParticipant::where('id', $id);
        return $query->first();
    }

    public function create(
        array $data
    ) {
        // jika ada kesalahan data maka data tidak otomatis keinput
        DB::beginTransaction();

        try {
            $event = new EventParticipant;
            $event->thumbnail = $data['thumbnail']->store('assets/event', 'public');
            $event->name = $data['name'];
            $event->description = $data['description'];
            $event->price = $data['price'];
            $event->date = $data['date'];
            $event->time = $data['time'];
            if (isset($data['is_active'])) {
                $event->is_active = $data['is_active'];
            }
            $event->save();

            DB::commit();

            return $event;
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
            $event = EventParticipant::find($id);

            if (isset($data['thumbnail'])) {
                $event->thumbnail = $data['thumbnail']->store('assets/event', 'public');
            }

            $event->name = $data['name'];
            $event->description = $data['description'];
            $event->price = $data['price'];
            $event->date = $data['date'];
            $event->time = $data['time'];
            
            if (isset($data['is_active'])) {
                $event->is_active = $data['is_active'];
            }

            $event->save();

            DB::commit();

            return $event;
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
            $event = EventParticipant::find($id);

            $event->delete();

            DB::commit();

            return $event;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }
}
