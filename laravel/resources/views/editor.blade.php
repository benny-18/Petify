<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Petify - Missing Pet Template</title>
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}" />
    <link
      href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&family=Syne:wght@400;500;700&family=Almarai:wght@400;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="app-container">
      <header class="app-header">
        <div class="logo-container">
          <img src="https://cdn.builder.io/api/v1/image/assets/3cc4bc3e52714dc98afd866a406b78dd/77c540a6be2a96ef613bdcbb05422cc4e122f67c?placeholderIfAbsent=true" alt="Petify Logo" class="logo-image" />
          <h1 class="logo-text">Petify</h2>
        </div>
        <img src="https://cdn.builder.io/api/v1/image/assets/3cc4bc3e52714dc98afd866a406b78dd/b861cda4be69fed78fe637ecaba9b7eaad2f7d24?placeholderIfAbsent=true" alt="User Profile" class="profile-image" />
      </header>

      <main class="main-content">
        <aside class="sidebar">
          <h2 class="sidebar-title">TEMPLATES</h2>
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
          <div class="content-container">
            <section class="preview-section">
              <div class="image-preview">
                <img src="https://cdn.builder.io/api/v1/image/assets/3cc4bc3e52714dc98afd866a406b78dd/b9460a7a60b31bda54777801a924e74e48d512d0?placeholderIfAbsent=true" alt="Pet Image Preview" class="pet-image" />
              </div>
            </section>

            <section class="form-section">
              <h2 class="project-title">Project title</h2>
              <p class="project-description">
                Some description about the project...
              </p>
              <p class="project-meta">Marvin Masubay • Thu Apr 17 2025</p>

              <div class="form-divider"></div>

              <div class="form-row">
                <img
                  src="https://cdn.builder.io/api/v1/image/assets/3cc4bc3e52714dc98afd866a406b78dd/76b9b3ea20d08d85f9e28e134e83d10434f8f3c6?placeholderIfAbsent=true"
                  alt="Import Image"
                  class="import-image-button"
                />
                <div class="input-field pet-name-field">
                  <input type="text" placeholder="Pet name" />
                </div>
              </div>

              <div class="form-row">
                <div class="input-field age-field">
                  <input type="text" placeholder="Age" />
                </div>
                <div class="input-field breed-field">
                  <input type="text" placeholder="Breed, if available" />
                </div>
              </div>

              <div class="form-row">
                <div class="input-field contact-person-field">
                  <input type="text" placeholder="Contact Person" />
                </div>
                <div class="input-field contact-number-field">
                  <input type="text" placeholder="Contact Number" />
                </div>
              </div>

              <div class="input-field description-field">
                <textarea placeholder="Pet description"></textarea>
              </div>

              <div class="input-field reward-field">
                <input type="text" placeholder="Reward (leave empty if none)" />
              </div>

              <button class="save-button">SAVE AND DOWNLOAD</button>
            </section>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
