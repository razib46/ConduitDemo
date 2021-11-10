import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

import { ApiService } from './api.service';
import { map } from 'rxjs/operators';
import { Role } from '../models/role.model';

@Injectable()
export class RolesService {
    constructor(
        private apiService: ApiService
    ) { }

    getAll(): Observable<[Role]> {
        return this.apiService.get('/roles')
            .pipe(map(data => data.roles));
    }
}