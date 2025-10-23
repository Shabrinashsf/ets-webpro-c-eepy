<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $katakunci = '';
    public $entries = 10;
    public $showEditModal = false;
    public $editingUserId = null;
    public $name, $email, $telp_number;

    protected $paginationTheme = 'tailwind';
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'telp_number' => 'nullable|string|max:20',
    ];

    public function updatingKatakunci()
    {
        $this->resetPage();
    }

    public function render()
    {
        $dataUsers = User::query()
            ->when($this->katakunci, function($query) {
                $query->where('name', 'like', '%' . $this->katakunci . '%')
                      ->orWhere('email', 'like', '%' . $this->katakunci . '%');
            })
            ->paginate($this->entries);

        return view('livewire.users-table', [
            'dataUsers' => $dataUsers,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->editingUserId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->telp_number = $user->telp_number;

        $this->showEditModal = true;
    }

    public function updateUser()
    {
        $this->validate();

        $user = User::findOrFail($this->editingUserId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'telp_number' => $this->telp_number,
        ]);

        $this->showEditModal = false;
        $this->dispatch('userUpdated'); // buat notifikasi kalo mau nanti
    }

    public function closeModal()
    {
        $this->reset(['showEditModal', 'editingUserId', 'name', 'email', 'telp_number']);
    }
}
