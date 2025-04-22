<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Petify - Editor</title>
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
              src="https://cdn.builder.io/api/v1/image/assets/3cc4bc3e52714dc98afd866a406b78dd/896254c54c76484cf22d10c78f0d32e9cf61b7c1?placeholderIfAbsent=true"
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
            </div>
                <img src="https://cdn.builder.io/api/v1/image/assets/3cc4bc3e52714dc98afd866a406b78dd/b861cda4be69fed78fe637ecaba9b7eaad2f7d24?placeholderIfAbsent=true" alt="User Profile" class="profile-image" />
          </header>

          <div class="content-container">
          <section class="preview-section" id="previewSection">
            <div class="image-preview">
                <img src="https://cdn.builder.io/api/v1/image/assets/3cc4bc3e52714dc98afd866a406b78dd/b9460a7a60b31bda54777801a924e74e48d512d0?placeholderIfAbsent=true" alt="Pet Image Preview" class="pet-image" />
            </div>

            <button id="toggleZoomBtn" class="zoom-toggle-btn">Fit to Panel</button>
          </section>

            <!-- PROJECT NAME AND DESCRIPTION EDITOR -->
            <section class="form-section">
              <h2 class="project-title">{{ $project->title }}</h2>
              <p class="project-description">{{ $project->description }}</p>

              <p class="project-meta">
                {{ $project->user->firstname }} {{ $project->user->lastname }} •
                {{ $project->created_at->format('D M d, Y') }}
              </p>

              <div class="form-divider"></div>

            <div class="form-row">
                <div class="button-container">
                    <button class="importimg-button"></button>
                    <img src="https://img.icons8.com/?size=100&id=wdoEeeG1GGY6&format=png&color=757575" class="icon-overlay">
                </div>

                <div class="input-field pet-name-field">
                  <input type="text" name="petName" required placeholder="Pet name" />
                </div>

                <div class="input-field pet-sex-field">
                    <select name="petSex" required>
                        <option value="" disabled selected hidden>Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

              </div>

              <div class="form-row">
                <div class="input-field age-field">
                  <input type="number" placeholder="Age (years)" />
                </div>
                <div class="input-field breed-field">
                  <input type="text" placeholder="Breed, if available" />
                </div>
              </div>

              <div class="form-row">
                <div class="input-field contact-person-field">
                  <input type="text" name="contactPerson" required placeholder="Contact Person" />
                </div>
                <div class="input-field contact-number-field">
                  <input type="tel" name="contactNumber" required placeholder="Contact Number" />
                </div>
              </div>

              <div class="input-field description-field">
                <textarea placeholder="Pet description"></textarea>
              </div>

              <div class="input-field reward-field">
                <input type="number" placeholder="Reward (leave empty if none)" />
              </div>

              <button class="save-button" id="saveDownloadBtn">SAVE AND DOWNLOAD</button>
            </section>
          </div>
        </div>
      </main>
    </div>
  </body>

  <script src="{{ asset('js/editor.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
