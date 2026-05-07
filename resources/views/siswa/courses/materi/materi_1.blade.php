@foreach($materiTopics as $index => $topic)
<div x-show="currentStep === ({{$index}} + 1)">
    <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
        Ini adalah konten materi teks untuk Topik <strong style="color: #fff;">{{ $topic }}</strong> pada Materi 1.
    </p>
    <div class="code-block">
        // Contoh kode untuk {{ $topic }}
        console.log('Belajar {{ $topic }}');
    </div>
</div>
@endforeach
