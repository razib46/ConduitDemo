import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

import { ApiService } from './api.service';
import { map } from 'rxjs/operators';
import { Category } from '../models/category.model';

@Injectable()
export class CategoriesService {
    constructor(
        private apiService: ApiService
    ) { }

    getAll(): Observable<[Category]> {
        return this.apiService.get('/categories')
            .pipe(map(data => data.categories));
    }
}