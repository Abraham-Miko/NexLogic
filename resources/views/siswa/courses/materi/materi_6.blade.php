@foreach($materiTopics as $index => $topic)
<div x-show="currentStep === ($index + 1)" style="display: none;" x-effect="$el.style.display = (currentStep === ($index + 1)) ? 'block' : 'none'">
    <p style="color: #cbd5e1; line-height: 1.8; margin-bottom: 24px;">
        Ini adalah konten materi teks untuk Topik <strong style="color: #fff;">{{ $topic }}</strong> pada Materi 6.
    </p>
    <div class="code-block">
        // Contoh kode untuk {{ $topic }}
        console.log('Belajar {{ $topic }}');
    </div>
</div>
@endforeach
