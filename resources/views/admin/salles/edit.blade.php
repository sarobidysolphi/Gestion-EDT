@extends('admin.layout')

@section('content')
    <div style="max-width: 600px; margin: 0 auto;">
        <h1 style="color: #32CD32; text-align: center; margin-bottom: 20px;">Modifier une Salle</h1>
        <div class="glass-form">
            <form action="{{ route('salles.update', $salle->idsalle) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label>Désignation de la salle</label>
                    <input type="text" name="design" value="{{ $salle->design }}" required>
                </div>

                <button type="submit" class="btn-submit">Modifier</button>
                <a href="{{ route('salles.index') }}" class="btn-back">Retour</a>
            </form>
        </div>
    </div>

    <style>
        .glass-form {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 25px;
            padding: 30px 35px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 18px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            font-size: 1rem;
            outline: none;
            transition: 0.3s;
        }
        .form-group input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #32CD32;
            box-shadow: 0 0 10px rgba(50, 205, 50, 0.3);
        }
        .btn-submit {
            width: 100%;
            padding: 14px;
            border-radius: 50px;
            border: none;
            background: rgba(50, 205, 50, 0.2);
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            border: 1px solid rgba(50, 205, 50, 0.4);
            margin-top: 10px;
        }
        .btn-submit:hover {
            background: rgba(50, 205, 50, 0.4);
            box-shadow: 0 0 20px rgba(50, 205, 50, 0.2);
            transform: scale(1.02);
        }
        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.3s;
        }
        .btn-back:hover { color: #ffffff; }
    </style>
@endsection