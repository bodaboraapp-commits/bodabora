@extends('backend.partials.master')
@section('title')
    ⚡ ebikeGO Investor Leads & Sales Journey
@endsection
@section('maincontent')
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="breadcrumb-link">{{ __('levels.dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">ebikeGO Sales Journey & Leads</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Key Metrics Cards -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
            <div class="card border-3 border-top border-top-primary total-card-color h-100">
                <div class="card-body total-card-body">
                    <div class="text-center d-flex">
                        <label class="icon p-10px">
                            <i class="fas fa-users"></i>
                        </label>
                        <div class="box-content w-100 text-left">
                            <h5 class="text-muted">Total Investor Leads</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{ number_format($metrics['total_leads']) }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
            <div class="card border-3 border-top border-top-primary total-card-color h-100">
                <div class="card-body total-card-body">
                    <div class="text-center d-flex">
                        <label class="icon p-10px">
                            <i class="fas fa-wallet"></i>
                        </label>
                        <div class="box-content w-100 text-left">
                            <h5 class="text-muted">Capital Pledged</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">KSh {{ number_format($metrics['total_capital']) }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
            <div class="card border-3 border-top border-top-primary total-card-color h-100">
                <div class="card-body total-card-body">
                    <div class="text-center d-flex">
                        <label class="icon p-10px">
                            <i class="fas fa-motorcycle"></i>
                        </label>
                        <div class="box-content w-100 text-left">
                            <h5 class="text-muted">Bikes Funded</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{ number_format($metrics['total_bikes']) }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
            <div class="card border-3 border-top border-top-primary total-card-color h-100">
                <div class="card-body total-card-body">
                    <div class="text-center d-flex">
                        <label class="icon p-10px">
                            <i class="fas fa-chart-line"></i>
                        </label>
                        <div class="box-content w-100 text-left">
                            <h5 class="text-muted">Conversion Rate</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{ $metrics['conversion_rate'] }}%</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <form action="{{ route('admin.ev.invest.index') }}" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control" placeholder="Search by name, email, or phone..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="stage" class="form-control">
                            <option value="">All Sales Stages</option>
                            <option value="1" {{ request('stage') == 1 ? 'selected' : '' }}>1. Prospect / New Lead</option>
                            <option value="2" {{ request('stage') == 2 ? 'selected' : '' }}>2. Contacted</option>
                            <option value="3" {{ request('stage') == 3 ? 'selected' : '' }}>3. Negotiating / Committed</option>
                            <option value="4" {{ request('stage') == 4 ? 'selected' : '' }}>4. Converted (Customer)</option>
                            <option value="5" {{ request('stage') == 5 ? 'selected' : '' }}>5. Archived</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1"><i class="fa fa-filter mr-1"></i> Filter</button>
                        <a href="{{ route('admin.ev.invest.index') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Leads Table -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Investor Name</th>
                                    <th>Email / Phone</th>
                                    <th>KYC</th>
                                    <th>Bikes Funded</th>
                                    <th>Capital (KSh)</th>
                                    <th>Sales Journey Stage</th>
                                    <th>Date</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $stages = [
                                        1 => ['label' => 'Prospect', 'class' => 'badge bg-warning text-dark'],
                                        2 => ['label' => 'Contacted', 'class' => 'badge bg-info text-white'],
                                        3 => ['label' => 'Negotiating', 'class' => 'badge bg-primary text-white'],
                                        4 => ['label' => 'Converted', 'class' => 'badge bg-success text-white'],
                                        5 => ['label' => 'Archived', 'class' => 'badge bg-secondary text-white'],
                                    ];
                                    $i = 1;
                                @endphp
                                @forelse($investments as $inv)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><strong class="text-dark">{{ $inv->name }}</strong></td>
                                    <td>
                                        <div>{{ $inv->email }}</div>
                                        <small class="text-muted">{{ $inv->phone }}</small>
                                    </td>
                                    <td>
                                        @if($inv->national_id)
                                            <span class="badge bg-success text-white" title="National ID on file">ID ✓</span>
                                        @else
                                            <span class="badge bg-warning text-dark" title="No ID captured yet">ID missing</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-light text-dark border px-2 py-1">{{ $inv->bikes_count }} Bikes</span></td>
                                    <td><strong class="text-emerald-700">KSh {{ number_format($inv->total_investment, 2) }}</strong></td>
                                    <td>
                                        <span class="{{ $stages[$inv->stage]['class'] ?? 'badge bg-secondary text-white' }}">
                                            {{ $stages[$inv->stage]['label'] ?? 'Unknown' }}
                                        </span>
                                    </td>
                                    <td>{{ $inv->created_at->format('d M Y') }}</td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- Manage Stage Button -->
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#stageModal{{ $inv->id }}" title="Manage Sales Journey">
                                                <i class="fa fa-tasks"></i> Journey
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.ev.invest.delete', $inv->id) }}" method="POST" data-title="Delete this investor lead?" id="delete">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Lead">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Sales Journey Management Modal -->
                                <div class="modal fade" id="stageModal{{ $inv->id }}" tabindex="-1" aria-labelledby="stageModalLabel{{ $inv->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 border-0 shadow-lg">
                                            <div class="modal-header border-bottom">
                                                <h5 class="modal-title fw-bold" id="stageModalLabel{{ $inv->id }}">Manage Sales Journey: {{ $inv->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.ev.invest.stage', $inv->id) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body space-y-4 text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold text-muted small">Identity &amp; KYC</label>
                                                        <p class="mb-1"><strong>Email:</strong> {{ $inv->email }}</p>
                                                        <p class="mb-1"><strong>Phone:</strong> {{ $inv->phone }}</p>
                                                        <p class="mb-1"><strong>Country:</strong> {{ $inv->country ?: '—' }}</p>
                                                        <p class="mb-1"><strong>National ID / Passport:</strong> {{ $inv->national_id ?: 'Not provided' }}</p>
                                                        <p class="mb-1"><strong>Date of Birth:</strong> {{ $inv->date_of_birth ? $inv->date_of_birth->format('d M Y') : '—' }}</p>
                                                        <p class="mb-1"><strong>County / Town:</strong> {{ $inv->county ?: '—' }}</p>
                                                        <p class="mb-1"><strong>Occupation / Source of Funds:</strong> {{ $inv->occupation ?: '—' }}</p>
                                                        <p class="mb-1"><strong>KRA PIN:</strong> {{ $inv->kra_pin ?: '—' }}</p>
                                                        <p class="mb-0"><strong>Consent:</strong>
                                                            @if($inv->consent)
                                                                <span class="text-success">Given{{ $inv->consent_at ? ' on ' . $inv->consent_at->format('d M Y H:i') : '' }}</span>
                                                            @else
                                                                <span class="text-danger">Not recorded</span>
                                                            @endif
                                                        </p>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold text-muted small">Investment</label>
                                                        <p class="mb-1"><strong>Capital Pledged:</strong> KSh {{ number_format($inv->total_investment, 2) }} ({{ $inv->bikes_count }} Bikes)</p>
                                                        <p class="mb-1"><strong>Payment Method:</strong> {{ $inv->payment_method }}</p>
                                                        <p class="mb-0"><strong>Heard about us via:</strong> {{ $inv->referral_source ?: '—' }}</p>
                                                        @if($inv->notes)
                                                            <p class="mt-2 mb-0 bg-light p-2 rounded small"><strong>Notes:</strong> {{ $inv->notes }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="stageSelect{{ $inv->id }}" class="form-label fw-semibold">Update Sales Stage *</label>
                                                        <select name="stage" id="stageSelect{{ $inv->id }}" class="form-control" required>
                                                            <option value="1" {{ $inv->stage == 1 ? 'selected' : '' }}>1. Prospect / New Lead</option>
                                                            <option value="2" {{ $inv->stage == 2 ? 'selected' : '' }}>2. Contacted</option>
                                                            <option value="3" {{ $inv->stage == 3 ? 'selected' : '' }}>3. Negotiating / Committed</option>
                                                            <option value="4" {{ $inv->stage == 4 ? 'selected' : '' }}>4. Converted (Customer)</option>
                                                            <option value="5" {{ $inv->stage == 5 ? 'selected' : '' }}>5. Archived</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="adminNotes{{ $inv->id }}" class="form-label fw-semibold">Internal Admin Notes / Follow-up</label>
                                                        <textarea name="admin_notes" id="adminNotes{{ $inv->id }}" rows="3" class="form-control" placeholder="Add notes about calls, meetings, contract signing...">{{ $inv->admin_notes }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-top">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">No investor leads found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-3 d-flex flex-row-reverse align-items-center">
                    <span>{{ $investments->links() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
