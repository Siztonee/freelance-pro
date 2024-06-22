<?php

namespace App\Livewire\Chat;

use App\Events\MessageSendEvent;
use App\Models\Message;
use App\Models\Upload;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ChatComponent extends Component
{
    use WithFileUploads;

    public array $users;
    public int $sender_id;
    public int $receiver_id;
    public array $receiver;
    public string $message = '';
    public array $files = [];
    public array $messages;
    public bool $is_opened = false;

    public function mount($users, $receiver_id = null)
    {
        $this->users = $users;
        $this->sender_id = auth()->user()->id;

        if ($receiver_id !== null) {
            $this->selectChat($receiver_id);
        }
    }

    public function selectChat($receiver_id)
    {
        $this->is_opened = true;
        $this->sender_id = auth()->user()->id;
        $this->receiver_id = $receiver_id;
        $this->receiver = User::select('id', 'first_name', 'last_name', 'profile_image', 'specialization')
            ->where('id',$this->receiver_id)
            ->first()
            ->toArray();

        $this->loadMessages();
    }

    public function scrollToBottom()
    {
        $this->dispatch('scrollToBottom');
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                ->where('receiver_id', $this->sender_id);
        })
        ->with('uploads')
        ->get()
        ->toArray();

        $this->scrollToBottom();
    }

    public function sendMessage()
    {
        // Проверяем наличие файлов
        if ($this->files) {
            $this->validate([
                'files.*' => 'file|max:10240', // Ограничение размера файла (10 МБ)
            ]);
        }

        // Создаем новое сообщение
        $chatMessage = new Message();
        $chatMessage->sender_id = $this->sender_id;
        $chatMessage->receiver_id = $this->receiver_id;
        $chatMessage->message = $this->message;
        $chatMessage->save();

        // Сохраняем файлы
        if ($this->files) {
            foreach ($this->files as $file) {
                $originalFilename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $uniqueFilename = time() . '_' . uniqid() . '.' . $extension;
                $filePath = $file->storeAs('public/uploads', $uniqueFilename);

                $fileSize = $file->getSize();

                $chatFile = new Upload();
                $chatFile->message_id = $chatMessage->id;
                $chatFile->file_path = $filePath;
                $chatFile->file_size = $fileSize;
                $chatFile->file_name = $originalFilename;
                $chatFile->file_type = $extension;
                $chatFile->save();
            }
        }

        broadcast(new MessageSendEvent($chatMessage))->toOthers();

        unset($this->message, $this->files);

        $this->loadMessages();
        $this->scrollToBottom();
    }


    #[On('echo-private:chat-channel.{sender_id},MessageSendEvent')]
    public function listenForMessage($event)
    {
        $chatMessage = Message::whereId($event['message']['id'])
            ->with('uploads')
            ->first();
        $this->messages[] = $chatMessage;
    }



    public function render()
    {
        return view('livewire.chat.chat-component');
    }
}
