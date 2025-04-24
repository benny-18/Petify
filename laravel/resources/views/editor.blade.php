<!doctype html>
<html lang="en">
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
  <body>
    <div class="app-container">
      <main class="main-content">

        <aside class="sidebar" id="sidebar">
          <div class="horizontal-sidebar-title">
            <!-- <h2 class="sidebar-title-appname">Petify</h2> -->
            <h2 class="sidebar-title">Project Templates</h2>
          </div>
          <div class="sidebar-divider"></div>
          <div class="template-item selected">
            <img
              src="{{ asset('images/templates/missing-pet-template.png') }}"
              alt="Missing Pet Template"
              class="template-image"
            />
            <p class="template-name">Missing Pet</p>
          </div>
        </aside>

        <div class="content-area">

          <header class="app-header">
            <div class="logo-container">
                <!-- <img src="https://cdn.builder.io/api/v1/image/assets/3cc4bc3e52714dc98afd866a406b78dd/77c540a6be2a96ef613bdcbb05422cc4e122f67c?placeholderIfAbsent=true" alt="Petify Logo" class="menu-icon" id="toggleSidebar" onclick="toggleSidebar()" /> -->
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
                            <h2 style="color: #C50565" class="sidebar-title">Changes saved to cloud</h2>
                        </div>

                        <div id="save-progress" style="display: none; align-items: center; gap: 8px; opacity: 0; transition: opacity 0.5s ease;">
                            <img style="width: 26px" src="https://img.icons8.com/?size=100&id=sV1GrqFeGaYn&format=png&color=757575" alt="Save icon">
                            <h2 style="color: #757575" class="sidebar-title">Autosaving changes...</h2>
                        </div>
                    </div>

                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/pfp.jpg') }}" alt="User Profile" class="profile-image" />
                </div>

          </header>

          <div class="content-container">
            <section class="preview-section" id="previewSection">
                <div class="image-preview">
                    <img src="{{ asset('images/templates/missing-pet-template.png') }}" alt="Pet Image Preview" class="pet-image" />
                </div>

                <button id="toggleZoomBtn" class="zoom-toggle-btn">Fit to Panel</button>
            </section>

            <!-- PROJECT NAME AND DESCRIPTION EDITOR -->
            <form id="editorForm" data-project-id="{{ $project->id }}" method="POST" action="{{ route('project.update', $project->id) }}" class="form-section">

                @csrf
                @method('PUT')
              
              <!-- editable title -->
              <input type="text" name="title" value="{{ old('title', $project->title) }}" class="title-field project-title" />

              <!--editable desc -->
              <textarea name="description" ows="4" class="desc-field project description">{{ old('description', $project->description) }}</textarea>

              <p class="project-meta">
                {{ $project->user->firstname }} {{ $project->user->lastname }} •
                {{ $project->created_at->format('D M d, Y') }}
              </p>

              <div class="form-divider"></div>

                <div class="form-row">

                    <div class="button-container">
                        <button class="importimg-button" onclick="document.getElementById('file-input').click()"></button>
                        <input type="file" id="file-input" style="display:none;" accept="image/*" onchange="handleImageImport(event)" />
                        <img src="https://img.icons8.com/?size=100&id=wdoEeeG1GGY6&format=png&color=757575" class="icon-overlay">
                    </div>


                    <div class="input-field pet-name-field">
                    <input type="text" name="pet_name" value="{{ old('pet_name', $project->pet_name) }}" placeholder="Pet name" />
                    </div>

                    <div class="input-field pet-sex-field">
                        <select name="sex">
                            <option value="" disabled selected hidden>Sex</option>
                            <option value="Male" {{ $project->sex == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $project->sex == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                </div>

                <div class="form-row">
                    <div class="input-field age-field">
                    <input type="number" name="age" value="{{ old('age', $project->age) }}" placeholder="Age" />
                    </div>

                    <div class="input-field breed-field">
                    <select id="breed" value="{{ old('breed', $project->breed) }}" class="form-control" placeholder="Breed" />
                      <option value="" disabled selected>Select a breed</option>
                    </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-field contact-person-field">
                    <input type="text" name="contact_person" value="{{ old('contact_person', $project->contact_person) }}" placeholder="Contact Person" />
                    </div>
                    <div class="input-field contact-number-field">
                    <input type="tel" name="contact_number" value="{{ old('contact_number', $project->contact_number) }}" placeholder="Contact Number" />
                    </div>
                </div>

                <div class="input-field description-field">
                    <textarea name="pet_description" placeholder="Description">{{ old('pet_description', $project->pet_description) }}</textarea>
                </div>

                <div class="input-field reward-field">
                    <input type="number" step="0.01" name="reward" value="{{ old('reward', $project->reward) }}" placeholder="Reward (leave empty if none)" />
                </div>

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

</html>
