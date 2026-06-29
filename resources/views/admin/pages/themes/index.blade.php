@extends('admin.layouts.app')

@section('main')
    <style>
        .theme-settings-page {
            --theme-primary: #0d6efd;
            --theme-soft: #f6f8fb;
            --theme-border: #e8edf3;
            --theme-text: #1f2937;
            --theme-muted: #6b7280;
        }

        .theme-settings-page .page-hero {
            background: linear-gradient(135deg, #ffffff 0%, #f7faff 100%);
            border: 1px solid var(--theme-border);
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        }

        .theme-settings-page .page-hero h3 {
            margin-bottom: 6px;
            font-weight: 700;
            color: var(--theme-text);
        }

        .theme-settings-page .page-hero p {
            margin-bottom: 0;
            color: var(--theme-muted);
        }

        .theme-settings-page .settings-card {
            border: 1px solid var(--theme-border);
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .theme-settings-page .settings-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--theme-border);
            padding: 18px 22px;
        }

        .theme-settings-page .settings-card .card-title {
            margin-bottom: 2px;
            font-weight: 700;
            color: var(--theme-text);
        }

        .theme-settings-page .section-subtitle {
            color: var(--theme-muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .theme-settings-page .form-section {
            padding: 22px;
            border-bottom: 1px solid var(--theme-border);
        }

        .theme-settings-page .form-section:last-child {
            border-bottom: none;
        }

        .theme-settings-page .section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--theme-text);
            margin-bottom: 16px;
        }

        .theme-settings-page label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .theme-settings-page .form-control {
            border-radius: 10px;
            border-color: #d9e1ec;
            min-height: 44px;
        }

        .theme-settings-page .form-control:focus {
            border-color: var(--theme-primary);
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.12);
        }

        .theme-settings-page .helper-text {
            color: var(--theme-muted);
            font-size: 13px;
            margin-top: 6px;
        }

        .theme-settings-page .asset-preview {
            background: var(--theme-soft);
            border: 1px dashed #ccd6e3;
            border-radius: 14px;
            padding: 16px;
            min-height: 116px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .theme-settings-page .asset-preview img {
            max-width: 100%;
            max-height: 110px;
            object-fit: contain;
        }

        .theme-settings-page .asset-preview.logo-preview img,
        .theme-settings-page .asset-preview.favicon-preview img {
            max-width: 120px;
            max-height: 90px;
        }

        .theme-settings-page .upload-box {
            background: #ffffff;
            border: 1px solid var(--theme-border);
            border-radius: 14px;
            padding: 16px;
            height: 100%;
        }

        .theme-settings-page .social-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .theme-settings-page .action-footer {
            background: #ffffff;
            border-top: 1px solid var(--theme-border);
            padding: 18px 22px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .theme-settings-page .btn-primary {
            border-radius: 10px;
            padding: 10px 22px;
            font-weight: 600;
        }

        @media (max-width: 767px) {
            .theme-settings-page .page-hero {
                padding: 18px;
            }

            .theme-settings-page .form-section {
                padding: 18px;
            }

            .theme-settings-page .social-grid {
                grid-template-columns: 1fr;
            }

            .theme-settings-page .action-footer {
                justify-content: stretch;
            }

            .theme-settings-page .action-footer .btn {
                width: 100%;
            }
        }
    </style>

    <div class="theme-settings-page">
        <div class="page-hero">
            <h3>Theme Options</h3>
            <p>Manage platform identity, logos, partner visuals, social links, video, and copyright information.</p>
        </div>

        @include('validate')

        @php
            $social = json_decode($theme->social, false);
        @endphp

        <form action="{{ route('theme-option.update', 1) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card settings-card">
                <div class="card-header">
                    <h4 class="card-title">Basic Information</h4>
                    <p class="section-subtitle">Update the title and tagline used across the platform.</p>
                </div>

                <div class="form-section">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="theme-title">Title</label>
                            <input id="theme-title" type="text" name="title" value="{{ $theme->title }}"
                                class="form-control" placeholder="Enter platform title">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="theme-tagline">Tag Line</label>
                            <input id="theme-tagline" type="text" name="tagline" value="{{ $theme->tagline }}"
                                class="form-control" placeholder="Enter tagline">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card settings-card">
                <div class="card-header">
                    <h4 class="card-title">Brand Assets</h4>
                    <p class="section-subtitle">Upload favicon, main logo, and partner image assets.</p>
                </div>

                <div class="form-section">
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="upload-box">
                                <label>Favicon</label>
                                <div class="asset-preview favicon-preview">
                                    @if ($theme->favicon == 'favicon.ico')
                                        <img src="{{ asset('storage/logo/favicon.ico') }}" alt="Favicon">
                                    @else
                                        <img src="{{ asset('storage/logo/' . $theme->favicon) }}" alt="Favicon">
                                    @endif
                                </div>
                                <input type="hidden" name="old_favicon" value="{{ $theme->favicon }}">
                                <input class="form-control" name="favicon" type="file">
                                <p class="helper-text">Upload a square icon for browser tabs.</p>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <div class="upload-box">
                                <label>Logo</label>
                                <div class="asset-preview logo-preview">
                                    @if ($theme->logo == 'logo.png')
                                        <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo">
                                    @else
                                        <img src="{{ asset('storage/logo/' . $theme->logo) }}" alt="Logo">
                                    @endif
                                </div>
                                <input type="hidden" name="old_logo" value="{{ $theme->logo }}">
                                <input class="form-control" name="logo" type="file">
                                <p class="helper-text">Upload the main platform logo.</p>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <div class="upload-box">
                                <label>Partners</label>
                                <div class="asset-preview">
                                    <img src="{{ asset('storage/logo/' . $theme->partners) }}" alt="Partners">
                                </div>
                                <input type="hidden" name="old_partners" value="{{ $theme->partners }}">
                                <input class="form-control" name="partners" type="file">
                                <p class="helper-text">Upload the partner logo strip or visual.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card settings-card">
                <div class="card-header">
                    <h4 class="card-title">Social Links</h4>
                    <p class="section-subtitle">Add or update official social media URLs.</p>
                </div>

                <div class="form-section">
                    <div class="social-grid">
                        <div class="form-group mb-0">
                            <label for="facebook">Facebook</label>
                            <input id="facebook" type="text" name="facebook" value="{{ $social->facebook ?? '' }}"
                                class="form-control" placeholder="Facebook URL">
                        </div>

                        <div class="form-group mb-0">
                            <label for="twitter">Twitter</label>
                            <input id="twitter" type="text" name="twitter" value="{{ $social->twitter ?? '' }}"
                                class="form-control" placeholder="Twitter URL">
                        </div>

                        <div class="form-group mb-0">
                            <label for="linkedin">LinkedIn</label>
                            <input id="linkedin" type="text" name="linkedin" value="{{ $social->linkedin ?? '' }}"
                                class="form-control" placeholder="LinkedIn URL">
                        </div>

                        <div class="form-group mb-0">
                            <label for="instagram">Instagram</label>
                            <input id="instagram" type="text" name="instagram"
                                value="{{ $social->instagram ?? '' }}" class="form-control" placeholder="Instagram URL">
                        </div>

                        <div class="form-group mb-0">
                            <label for="youtube">YouTube</label>
                            <input id="youtube" type="text" name="youtube" value="{{ $social->youtube ?? '' }}"
                                class="form-control" placeholder="YouTube URL">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card settings-card">
                <div class="card-header">
                    <h4 class="card-title">Additional Information</h4>
                    <p class="section-subtitle">Manage video and copyright details shown on the website.</p>
                </div>

                <div class="form-section">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="video">Video</label>
                            <input id="video" type="text" name="video" value="{{ $theme->video }}"
                                class="form-control" placeholder="Video URL">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="copyright">Copyright</label>
                            <input id="copyright" type="text" name="copyright" value="{{ $theme->copyright }}"
                                class="form-control" placeholder="Copyright text">
                        </div>
                    </div>
                </div>

                <div class="action-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
@endsection
