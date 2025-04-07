    <link rel="stylesheet" href="{{ asset('css/colorscheme.css') }}" />
    <style>
        body {
            background-color: var(--background);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .auth-container {
            background-color: var(--toolbar-background);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            margin: 1rem;
        }

        h1 {
            color: var(--heading-color);
            margin-top: 0;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--muted-text);
            border-radius: 4px;
            background-color: var(--background);
            color: var(--text-color);
            font-size: 1rem;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: var(--link-color);
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--heading-color);
            color: var(--text-color);
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: var(--link-hover-color);
        }

        .auth-footer {
            margin-top: 1.5rem;
            text-align: center;
            color: var(--muted-text);
        }

        .auth-footer a {
            color: var(--link-color);
            text-decoration: none;
        }

        .auth-footer a:hover {
            color: var(--link-hover-color);
            text-decoration: underline;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .success-message {
            color: var(--success-color);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .hidden {
            display: none;
        }
    </style>
