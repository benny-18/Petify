<!doctype html>
<html lang="en">

  @livewireStyles
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Petify - Editor</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}" />
    <link
      href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&family=Syne:wght@400;500;700&family=Almarai:wght@400;700&display=swap"
      rel="stylesheet"
    />
  </head>


  <script>
    window.addEventListener('load', function () {
        setTimeout(function () {
        const loader = document.getElementById('loader-anim');
        loader.classList.add('fade-out');
        setTimeout(() => {
            loader.style.display = 'none';
        }, 1000);
        }, 1000);
    });
  </script>


  @livewireScripts
  <body>


    <div id="loader-anim">
        <span class="loader-content">
            <h1 class="logo-text">Petify</h2>
            <img src="https://i.pinimg.com/originals/18/f5/66/18f566fa5cf046c1e81fc6c61ce5dc53.gif" alt="Loading...">
            <h1 class="loader-text">Generating preview...</h1>
        </span>
    </div>


    <div class="app-container">
      <main class="main-content">

        <aside class="sidebar" id="sidebar">
          <div class="horizontal-sidebar-title">
            <!-- <h2 class="sidebar-title-appname">Petify</h2> -->
            <h2 class="sidebar-title">Project Templates</h2>
          </div>
          <div class="sidebar-divider"></div>

            <div class="template-item" data-template-id="template-1">
                <img src="{{ asset('images/templates/thumbs/template-1.webp') }}" alt="Template 1" class="template-image" />
                <p class="template-name">Missing Pet 1</p>
            </div>

            <div class="template-item" data-template-id="template-2">
                <img src="{{ asset('images/templates/thumbs/template-2.webp') }}" alt="Template 2" class="template-image" />
                <p class="template-name">Missing Pet 2</p>
            </div>

        </aside>

        <div class="content-area">

          <header class="app-header">
            <div class="logo-container">
                <div id="toggleSidebar" class="menu-icon-container" onclick="toggleSidebar()">
                    <img src="https://img.icons8.com/?size=100&id=OTxpMqWbm71F&format=png&color=c50565"
                        alt="Menu Icon"
                        class="menu-icon icon-menu" />

                    <img src="https://img.icons8.com/?size=100&id=2i5n7zNvArOt&format=png&color=c50565"
                        alt="Close Icon"
                        class="menu-icon icon-close visible" />
                </div>

                <h1 class="logo-text">Petify</h2>

                <a href="{{ route('dashboard') }}" class="btn-back-dashboard">
                  Back to Dashboard
                </a>
            </div>
                <div style="display: flex; align-items: center; gap: 30px">
                    <div class="save-indicators">
                        <div id="save-success" style="display: none; align-items: center; gap: 8px; opacity: 0; transition: opacity 0.5s ease;">
                            <img style="width: 26px" src="https://img.icons8.com/?size=100&id=a2LNYNfCGquh&format=png&color=c50565" alt="Save icon">
                            <h2 style="color: #C50565" class="sidebar-title">Changes saved!</h2>
                        </div>

                        <div id="save-progress" style="display: none; align-items: center; gap: 8px; opacity: 0; transition: opacity 0.5s ease;">
                            <img style="width: 26px" src="https://img.icons8.com/?size=100&id=sV1GrqFeGaYn&format=png&color=757575" alt="Save icon">
                            <h2 style="color: #757575" class="sidebar-title">Autosaving changes...</h2>
                        </div>
                    </div>

                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/pfp.jpg') }}" alt="User Profile" class="profile-image" />
                </div>

          </header>


          <!-- template part -->
          <div class="content-container">
            <section class="preview-section" id="previewSection">

                <!-- <div class="image-preview">
                    <img src="{{ asset('images/templates/missing-pet-template.png') }}" alt="Pet Image Preview" class="pet-image" />
                </div> -->

                <div class="pet-image" id="poster-image" style="width: 794px; scale: 0.65; transform-origin: center; height: 1122px;">
                    <div id="poster-preview" style="transform: scale(0.5); transform-origin: top center;">
                        @livewire('poster-editor', [
                            'projectId' => $project->id,
                            'templateId' => $project->template_id,
                            'petName' => $project->pet_name,
                            'petDescription' => $project->pet_description,
                            'petBreed' => $project->breed,
                            'petAge' => $project->age,
                            'petSex' => $project->sex,
                            'contactPerson' => $project->contact_person,
                            'contactNumber' => $project->contact_number,
                            'petImage' => $project->pet_photo
                        ])
                    </div>
                </div>

                <!-- <button id="toggleZoomBtn" class="zoom-toggle-btn">Fit to Panel</button> -->

            </section>

            <!-- PROJECT NAME AND DESCRIPTION EDITOR -->
            <form id="editorForm" data-project-id="{{ $project->id }}" method="POST" action="{{ route('project.update', $project->id) }}" class="form-section" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <input type="hidden" id="project-id" value="{{ $project->id }}">

              <!-- editable title -->
              <input type="text" name="title" placeholder="Project Title" value="{{ old('title', $project->title) }}" class="title-field project-title" />

              <!--editable desc -->
              <textarea name="description" ows="4" class="desc-field project description" placeholder="Project Description">{{ old('description', $project->description) }}</textarea>

              <p class="project-meta">
                Created by {{ $project->user->firstname }} {{ $project->user->lastname }}  •
                {{ $project->created_at->format('D M d, Y') }}
              </p>

              <div class="form-divider"></div>

                <div class="form-row">
                    <!-- Pet photo upload -->
                    <div class="button-container">
                        <input class="importimg-button" type="file" wire:model.live="petImage" name="pet_photo" accept="image/*"  onchange="handleImageUpload()">
                            <img src="https://img.icons8.com/?size=100&id=wdoEeeG1GGY6&format=png&color=757575" class="icon-overlay">
                            <!-- <input type="file" wire:model.live="petImage" name="pet_photo" accept="image/*"  onchange="handleImageUpload()" class="mb-4" /> -->
                        </input>
                    </div>
                        <!-- <input wire:model.live="petImage" type="file" id="file-input" style="display:none;" accept="image/*" onchange="handleImageImport(event)" /> -->

                    <!-- pet name -->
                    <div class="input-field pet-name-field">
                    <input type="text" wire:model.live="petName" name="pet_name" value="{{ old('pet_name', $project->pet_name) }}" placeholder="Pet name" />
                    </div>

                    <!-- pet sex -->
                    <div class="input-field pet-sex-field">
                        <select name="sex">
                            <option value="" disabled selected hidden>Sex</option>
                            <option value="Male" {{ $project->sex == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $project->sex == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                </div>

                <!-- pet age -->
                <div class="form-row">
                    <div class="input-field age-field">
                    <input type="number" name="age" value="{{ old('age', $project->age) }}" placeholder="Age" />
                    </div>

                    <!-- pet breed-->
                    <div class="input-field breed-field">
                    <select name="breed" id="breed" class="form-control">
                      <option value="" disabled selected>Select a breed</option>
                    </select>
                    </div>
                </div>

                <!-- contact -->
                <div class="form-row">
                    <div class="input-field contact-person-field">
                    <input type="text" name="contact_person" value="{{ old('contact_person', $project->contact_person) }}" placeholder="Contact Person" />
                    </div>
                    <div class="input-field contact-number-field">
                    <input type="tel" name="contact_number" wire:model.live="contactNumber" value="{{ old('contact_number', $project->contact_number) }}" minlength="8" placeholder="Contact Number" />
                    </div>
                </div>

                <div class="input-field description-field">
                    <textarea wire:model.live="petDescription" name="pet_description" placeholder="Description">{{ old('pet_description', $project->pet_description) }}</textarea>
                </div>

                <!-- <div class="input-field reward-field">
                    <input type="number" wire:model.live="reward" step="0.01" name="reward" value="{{ old('reward', $project->reward) }}" placeholder="Reward (leave empty if none)" />
                </div> -->

                <button class="save-button" id="saveDownloadBtn">DOWNLOAD DESIGN</button>
                </div>

            </form>
          </div>

        </div>
      </main>
    </div>
  </body>

  <script src="{{ asset('js/editor.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <script>
    // breed selector
    document.addEventListener('DOMContentLoaded', function () {
        const selectedBreed = @json(old('breed', $project->breed));

        fetch('/data/breeds.json')
            .then(response => response.json())
            .then(breeds => {
                const select = document.getElementById('breed');

                breeds.forEach(breed => {
                    const option = document.createElement('option');
                    option.value = breed;
                    option.textContent = breed;

                    if (breed === selectedBreed) {
                        option.selected = true;
                    }

                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error loading breeds:', error);
            });
    });
  </script>

  <!-- Add this script block to listen for the event -->
<script>
    Livewire.on('reloadPage', function() {
        // Reload the page after the pet image is uploaded and saved
        location.reload();  // This reloads the whole page
    });
</script>
</html>
