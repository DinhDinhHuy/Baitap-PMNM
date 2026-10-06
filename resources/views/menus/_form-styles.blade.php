@push('styles')
    <style>
        .menu-form-page .page-heading {
            margin-bottom: 24px;
        }

        .menu-form-page .page-title {
            margin-bottom: 4px;
        }

        .menu-form-page .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .menu-form-page .form-card {
            max-width: 760px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 16px rgb(15 23 42 / 5%);
        }

        .menu-form-page .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 16px;
        }

        .menu-form-page .menu-field {
            min-width: 0;
        }

        .menu-form-page .menu-field-wide {
            grid-column: 1 / -1;
        }

        .menu-form-page .menu-field label {
            display: block;
            margin-bottom: 6px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .menu-form-page .required-mark {
            color: #dc2626;
        }

        .menu-form-page .menu-field input,
        .menu-form-page .menu-field select {
            width: 100%;
            min-height: 42px;
            padding: 9px 11px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: #fff;
            color: #1e293b;
            font-size: 14px;
            transition: border-color .15s, box-shadow .15s;
        }

        .menu-form-page .menu-field input:focus,
        .menu-form-page .menu-field select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgb(59 130 246 / 14%);
            outline: 0;
        }

        .menu-form-page .menu-field input.is-invalid,
        .menu-form-page .menu-field select.is-invalid {
            border-color: #dc2626;
        }

        .menu-form-page .field-help {
            margin-top: 6px;
            color: #64748b;
            font-size: 12px;
        }

        .menu-form-page .field-error {
            margin-top: 5px;
            color: #b91c1c;
            font-size: 13px;
        }

        .menu-form-page .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #edf1f5;
        }

        .menu-form-page .form-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 9px 14px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background-color .15s, border-color .15s;
        }

        .menu-form-page .form-button-primary {
            background: #0875e1;
            box-shadow: 0 4px 10px rgb(8 117 225 / 18%);
            color: #fff;
            transition: background-color .2s, box-shadow .2s, transform .2s;
        }

        .menu-form-page .form-button-primary:hover {
            background: #0563c2;
            box-shadow: 0 6px 14px rgb(8 117 225 / 24%);
            transform: translateY(-1px);
        }

        .menu-form-page .form-button-secondary {
            border-color: #cbd5e1;
            background: #fff;
            color: #475569;
            transition: background-color .15s, border-color .15s;
        }

        .menu-form-page .form-button-secondary:hover {
            background: #f1f5f9;
        }

        .menu-form-page .form-button:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 2px;
        }

        @media (max-width: 600px) {
            .menu-form-page .form-card {
                padding: 18px;
            }

            .menu-form-page .form-grid {
                grid-template-columns: 1fr;
            }

            .menu-form-page .menu-field-wide {
                grid-column: auto;
            }
        }
    </style>
@endpush
