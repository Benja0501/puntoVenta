{{-- Modal Crear Proveedor --}}
<div class="modal fade" id="providerModalCreate" tabindex="-1" aria-labelledby="providerModalCreateLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('providers.store') }}" method="POST" novalidate>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="providerModalCreateLabel">Nuevo Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    {{-- Nombre --}}
                    <div class="mb-3">
                        <label for="createProviderName" class="form-label">Nombre</label>
                        <input type="text" name="name" id="createProviderName"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="createProviderEmail" class="form-label">Email</label>
                        <input type="email" name="email" id="createProviderEmail"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- RUC --}}
                    <div class="mb-3">
                        <label for="createProviderRuc" class="form-label">RUC</label>
                        <input type="text" name="ruc_number" id="createProviderRuc"
                            class="form-control @error('ruc_number') is-invalid @enderror"
                            value="{{ old('ruc_number') }}" required maxlength="11" minlength="11">
                        @error('ruc_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Dirección --}}
                    <div class="mb-3">
                        <label for="createProviderAddress" class="form-label">Dirección</label>
                        <input type="text" name="address" id="createProviderAddress"
                            class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Teléfono --}}
                    <div class="mb-3">
                        <label for="createProviderPhone" class="form-label">Teléfono</label>
                        <input type="text" name="phone" id="createProviderPhone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                            required maxlength="9" minlength="9">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Abrir modal si hay errores --}}
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('providerModalCreate'));
            myModal.show();
        });
    </script>
@endif
