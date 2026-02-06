<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmployeeMail;

class EmployeeManager extends Component
{
    use WithPagination;

    public $search = '';
    public $employeeId, $full_name, $email, $position, $phone, $tags, $status = 'Activo';
    public $isOpen = false;
    public $isViewing = false;

    // Lista de correos con privilegios de administrador
    protected $adminEmails = ['satafykerplay@gmail.com', 'admin@prueba.com'];

    protected $rules = [
        'full_name' => 'required|min:3',
        'email' => 'required|email',
        'position' => 'required',
    ];

    public function render()
    {
        $query = Employee::query();
        
        // Seguridad: Si no es uno de los admin originales, solo ve sus propios datos
        if (!in_array(auth()->user()->email, $this->adminEmails)) {
            $query->where('email', auth()->user()->email);
        }

        return view('livewire.employee-manager', [
            'employees' => $query->where(function($q) {
                    $q->where('full_name', 'like', '%'.$this->search.'%')
                      ->orWhere('email', 'like', '%'.$this->search.'%')
                      ->orWhere('tags', 'like', '%'.$this->search.'%');
                })
                ->latest()
                ->paginate(10)
        ]);
    }

    public function store()
    {
        // Solo los administradores originales pueden registrar o editar
        if (!in_array(auth()->user()->email, $this->adminEmails)) {
            session()->flash('error', 'No tienes permisos para realizar esta acción.');
            return;
        }

        $this->validate();
        $passwordTemp = 'password123';

        DB::transaction(function () use ($passwordTemp) {
            $isNew = is_null($this->employeeId);

            if ($isNew) {
                if (!User::where('email', $this->email)->exists()) {
                    User::create([
                        'name' => $this->full_name,
                        'email' => $this->email,
                        'password' => Hash::make($passwordTemp),
                        'role' => 'employee',
                    ]);

                    // Envío de credenciales por correo
                    try {
                        Mail::to($this->email)->send(new WelcomeEmployeeMail($this->full_name, $this->email, $passwordTemp));
                    } catch (\Exception $e) {
                        // El empleado se crea aunque el correo falle, pero avisamos en el log
                        \Log::error("Error enviando correo: " . $e->getMessage());
                    }
                }
            }

            Employee::updateOrCreate(['id' => $this->employeeId], [
                'full_name' => $this->full_name,
                'email' => $this->email,
                'position' => $this->position,
                'phone' => $this->phone,
                'tags' => $this->tags,
                'status' => $this->status,
                'user_id' => auth()->id(),
            ]);
        });

        session()->flash('message', $this->employeeId ? 'Empleado actualizado.' : 'Empleado creado y credenciales enviadas por correo.');
        $this->closeModal();
    }

    public function delete($id)
    {
        // Seguridad estricta para borrado
        if (!in_array(auth()->user()->email, $this->adminEmails)) {
            session()->flash('error', 'Acción denegada. Solo administradores pueden eliminar personal.');
            return;
        }

        $employee = Employee::findOrFail($id);
        User::where('email', $employee->email)->delete();
        $employee->delete();

        session()->flash('message', 'Empleado y cuenta eliminados correctamente.');
    }

    public function create() { $this->resetInput(); $this->isViewing = false; $this->isOpen = true; }
    public function edit($id) { $this->isViewing = false; $this->loadEmployee($id); }
    public function show($id) { $this->isViewing = true; $this->loadEmployee($id); }
    public function closeModal() { $this->isOpen = false; $this->resetInput(); }

    private function loadEmployee($id) {
        $employee = Employee::findOrFail($id);
        $this->employeeId = $id;
        $this->full_name = $employee->full_name;
        $this->email = $employee->email;
        $this->position = $employee->position;
        $this->phone = $employee->phone;
        $this->tags = $employee->tags;
        $this->status = $employee->status;
        $this->isOpen = true;
    }

    private function resetInput() {
        $this->reset(['full_name', 'email', 'position', 'phone', 'tags', 'employeeId', 'isViewing']);
        $this->status = 'Activo';
    }
}